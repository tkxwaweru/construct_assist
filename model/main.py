from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
from transformers import pipeline, AutoTokenizer, AutoModelForSequenceClassification
import torch
import os

# Initialize the app
app = FastAPI(
    title="Sentiment Analysis API",
    description="API for predicting sentiment using a pretrained XLM-RoBERTa model.",
    version="1.0"
)

# Load the model and tokenizer
model_path = os.path.join(os.path.dirname(__file__), "sentiment_model")
device = torch.device('cuda' if torch.cuda.is_available() else 'cpu')

tokenizer = AutoTokenizer.from_pretrained(model_path)
model = AutoModelForSequenceClassification.from_pretrained(model_path).to(device)
sentiment_pipeline = pipeline("sentiment-analysis", model=model, tokenizer=tokenizer, device=0 if device.type == 'cuda' else -1)

# Request schema
class SentimentRequest(BaseModel):
    text: str

# Response schema
class SentimentResponse(BaseModel):
    sentiment: str
    confidence: float

# Root endpoint
@app.get("/")
def read_root():
    return {"message": "Welcome to the Sentiment Analysis API!"}

# Sentiment prediction endpoint
@app.post("/predict", response_model=SentimentResponse)
def predict_sentiment(request: SentimentRequest):
    try:
        result = sentiment_pipeline(request.text)
        label = result[0]['label'].lower()  # "LABEL_0" -> "negative", "LABEL_1" -> "positive"

        # Map labels to human-readable sentiments
        sentiment_map = {
            "label_0": "negative",
            "label_1": "positive"
        }
        sentiment = sentiment_map.get(label, "unknown")  # Default to "unknown" if mapping fails
        confidence = result[0]['score']

        return SentimentResponse(sentiment=sentiment, confidence=confidence)

    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))


