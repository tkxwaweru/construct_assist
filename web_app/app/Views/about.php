<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>About Us page</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
            *{
                padding: 0;
                margin: 0;
                box-sizing: border-box;
                font-family: poppins;
            }
            #about-section {
                width: 100%;
                height: auto;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 80px 12%;
            }
            .about-left img{
                width: 420px;
                height: auto;
                transform: translateY(50px);
            }
            .about-right {
                width: 54%;
            }

            .about-right ul li {
                display: flex;
                align-items: center;
            }

            .about-right h1 {
                color: #0096FF;
                font-size: 37px;
                margin-bottom: 5px;
            }

            .about-right p {
                color: #444;
                line-height: 26px;
                font-size: 15px;
            }

            .about-right .address {
                margin: 25px 0;
            }

            .about-right .address ul li {
                margin-bottom: 5px;
            }

            .address .address-logo {
                margin-right: 15px;
                color: #0096FF;
            }

            .address .saprater {
                margin: 0 35px;
            }

            .about-right .expertise ul {
                width: 80%;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .expertise h3 {
                margin-bottom: 10px;
            }

            .expertise .expertise-logo {
                font-size: 19px;
                margin-right: 10px;
                color: #0096FF;
            }
        </style>
    </head>

    <body>
    <img src="<?= base_url('images/icon.png')?>" alt="logo" class="logo">
        <section id="about-section">
            <!-- about left  -->
            <div class="about-left">
                <img src="<?= base_url('images/construction-manager.jpg')?>" alt="About Img">
            </div>

            <!-- about right  -->
            <div class="about-right">
                <h4>About us</h4>
                <h1>Construct-Assist</h1>
                <p>
                  Construct-Assist is a tool that enables project managers to recruit a team of individuals 
                  to aid in their construction projects. Project managers receieve ratings-based recommendations on 
                  professionals or service providers that have been rated based on previously completed jobs. 
                  Construct-Assist is a user driven tool that relies on ratings from project managers to generate recommendations 
                  and to ensure that project managers collaborate with the best team possible.
                </p>
                <div class="address">
                    <ul>
                        <li>
                            <span class="address-logo">
                                <i class="fas fa-paper-plane"></i>
                            </span>
                            <p>Address</p>
                            <span class="saprater">:</span>
                            <p>Nairobi, Kenya</p>
                        </li>
                        <li>
                            <span class="address-logo">
                                <i class="fas fa-phone-alt"></i>
                            </span>
                            <p>Phone No.</p>
                            <span class="saprater">:</span>
                            <p>+254 - 702688832</p>
                        </li>
                        <li>
                            <span class="address-logo">
                                <i class="far fa-envelope"></i>
                            </span>
                            <p>Email</p>
                            <span class="saprater">:</span>
                            <p>construct-assist@gmail.com</p>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </body>

</html>
