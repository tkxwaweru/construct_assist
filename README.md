<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

# CONSTRUCT-ASSIST

## Quick Links

- [Introduction](https://github.com/tkxwaweru/construct_assist?tab=readme-ov-file#introduction)

- [Project installation](https://github.com/tkxwaweru/construct_assist?tab=readme-ov-file#project-installation)

- [Running the project](https://github.com/tkxwaweru/construct_assist?tab=readme-ov-file#running-the-project)

## Introduction

Construct-Assist is a web application that was developed to ease the acquisition of reliable construction professionals and service providers in Kenya. In Kenya, a major problem facing the construction industry is the scarcity of skilled and reliable professionals and service providers within the field. As a result of this, whenever foreign labour is unavailable, unskilled labour is often relied upon resulting in issues such as poor quality construction work and on the extreme end fatalities within the construction sites.

Construct-Assist provides project managers with a tools that allows them to review the services of the professionals or service providers that they worked with using English/Swahili or a mix of both languages. The system utilizes a sentiment analysis model in the backend to classify the reviews and thus classify professionals or service providers that are reliable or unreliable. Only those that are classified as reliable shall appear to project managers in recruitment searches.

The web application was developed using CodeIgniter4, the model was trained using Jupyter Notebook and the model API was developed using python and was tested locally using Uvicorn.  

## Project installation

Fork and clone this repository.

   Run the following command in your terminal to clone the forked repository:

   ```{code}
   git clone <repository link> <folder name>
   ```

Copy the link to the GitHub repository. You can specify your own repository name.

### Python dependencies:

Open your terminal and create a virtual python environment to store all the required dependencies to run this project. The project was created using python version 3.11.7 which can be installed automatically when working with anaconda environments or can be downloaded directly from [here](https://www.python.org/ftp/python/3.11.7/python-3.11.7-amd64.exe).

   If you prefer to use python's venv facility:

   ```{code}
   python3 -m venv environment_name
   ```

   You can read more on working with python and pip [here](https://packaging.python.org/en/latest/guides/installing-using-pip-and-virtual-environments/).

   If you prefer to use anaconda:

   ```{code}
   conda create -n environment_name
   ```

   You can read more on working with anaconda [here](https://docs.anaconda.com/free/navigator/tutorials/index.html).

   To install the python dependencies, navigate to the parent directory and run the following command:

   ```{code}
   pip install -r requirements/requirements.txt
   ```
   
### Composer and CodeIgniter4 related dependencies

#### Install Composer:
Composer is a dependency manager for PHP that is required for running CodeIgniter 4. Follow the steps below to install Composer:

Download and install Composer by visiting the Composer download page.

For Windows:

- Download the Composer-Setup.exe file.
- Run the installer and follow the instructions.

For macOS and Linux:

Run the following command in your terminal to download Composer:

```{code}
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
```
- Verify the installer’s integrity:

```{code}
php -r "if (hash_file('sha384', 'composer-setup.php') === 'YOUR_HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
```

Replace YOUR_HASH with the hash value from the Composer website.

- Install Composer globally:

```{code}
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
```

- Remove the installer:

```{code}
php -r "unlink('composer-setup.php');"
```

- Verify installation:

```{code}
composer --version
```

#### Install CodeIgniter 4:
- Navigate to the directory where you want to install CodeIgniter 4.

- Use Composer to create a new CodeIgniter 4 project:

```{code}
composer create-project codeigniter4/project_name
```
- Navigate to the project folder:

```{code}
cd project_name
```

Update project dependencies: 

```{code}
composer install --working-dir=requirements\
```

## Running the Project

Using your terminal:

1. Navigate to the <b>web_app</b> directory within your cloned repository and run the following command:

```{code}
php spark serve
```

2. Navigate to the <b>model</b> directory within your cloned repository and run the following command:

```{code}
uvicorn main:app --reload
```

3. Open a browser and navigate to <b>http://localhost:8080/home</b> to run the web application.


