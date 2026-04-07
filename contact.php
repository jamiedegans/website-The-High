<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact – The High Solan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;900&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>


    <!-- ===================== HEADER ===================== -->
    <?php
    include_once 'costums/header.php';
    ?>
    <!-- ===================== MAIN ===================== -->
    <main class="site-main">

        <div class="page-header">
            <h2>Contact</h2>
            <p>Visit us or get in touch</p>
        </div>

        <div class="inner" style="padding-bottom:5rem;">
            <div class="contact-layout">


                <!-- Left: location info -->
                <div class="contact-info">
                    <h3>Find Us</h3>

                    <div class="contact-item">
                        <i class="fa fa-map-marker-alt"></i>
                        <span>Op De Dijk, Amsterdam</span>
                    </div>
                    <div class="contact-item">
                        <i class="fa fa-clock"></i>
                        <span>Monday – Sunday: 12:00 – 23:00</span>
                    </div>
                    <div class="contact-item">
                        <i class="fa fa-phone"></i>
                        <span>+31 20 000 0000</span>
                    </div>
                    <div class="contact-item">
                        <i class="fa fa-envelope"></i>
                        <span>info@thehighsolan.nl</span>
                    </div>
                    <div class="contact-item">
                        <i class="fa fa-instagram"></i>
                        <span>@thehighsolan</span>
                    </div>

                </div>


                <!-- Right: contact form -->
                <!-- TODO: add action="/api/contact" method="POST" when backend is ready -->
                <form class="contact-form" id="contact-form" onsubmit="handleContact(event)">
                    <h3>Send a Message</h3>

                    <div class="form-group">
                        <label class="form-label">Your Name</label>
                        <input type="text" class="form-input" placeholder="Full name" required />
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-input" placeholder="you@example.com" required />
                    </div>

                    <div class="form-group">
                        <label class="form-label">Subject</label>
                        <select class="form-input form-select">
                            <option value="">Select a subject</option>
                            <option value="reservation">Reservation</option>
                            <option value="feedback">Feedback</option>
                            <option value="allergy">Allergy question</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Message</label>
                        <textarea class="form-input form-textarea" placeholder="Your message..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-paper-plane"></i> Send Message
                    </button>

                    <!-- Confirmation shown after submit -->
                    <p id="contact-notice" class="form-success" style="margin-top:0.75rem;"></p>

                </form>


            </div>
        </div>

    </main>


    <!-- ===================== FOOTER ===================== -->
       <?php
    include_once 'costums/footer.php';
    ?>
    <!-- ===================== JAVASCRIPT ===================== -->
    <script src="javascript\javascript.js"></script>
</body>

</html>