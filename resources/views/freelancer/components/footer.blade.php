<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer with Logo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Main content area to push footer to bottom */
        .main-content {
            flex: 1;
            padding: 40px 0;
            text-align: center;
        }

        /* Footer Styles */
        .footer {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 0 15px;
            margin-top: auto;
            position: relative;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80') center/cover;
            opacity: 0.05;
            z-index: 1;
        }

        .footer .container {
            position: relative;
            z-index: 2;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
            gap: 25px;
            margin-bottom: 25px;
        }

        .footer-brand {
            padding-right: 15px;
        }

        .footer-brand .logo {
            max-width: 150px;
            height: auto;
            margin-bottom: 15px;
            filter: brightness(0) invert(1);
        }

        .footer-brand p {
            font-size: 0.9rem;
            line-height: 1.5;
            opacity: 0.9;
            margin-bottom: 20px;
        }

        .footer-section h4 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: white;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-section ul li {
            margin-bottom: 8px;
        }

        .footer-section ul li a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .footer-section ul li a:hover {
            color: white;
            transform: translateX(5px);
        }

        .contact-info {
            margin-top: 15px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.85rem;
        }

        .contact-item i {
            width: 16px;
            margin-right: 10px;
            color: #1dbf73;
        }

        .social-links {
            display: flex;
            gap: 12px;
            margin-top: 15px;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: white;
            text-decoration: none;
            font-size: 1rem;
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .social-links a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            padding-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .footer-bottom-links {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
        }

        .footer-bottom-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .footer-bottom-links a:hover {
            color: white;
        }

        .footer-copyright {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .footer-content {
                grid-template-columns: 1fr 1fr 1fr;
                gap: 30px;
            }
            
            .footer-brand {
                grid-column: 1 / -1;
                text-align: center;
                padding-right: 0;
            }
        }

        @media (max-width: 768px) {
            .footer-content {
                grid-template-columns: 1fr;
                gap: 30px;
                text-align: center;
            }
            
            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }
            
            .footer-bottom-links {
                justify-content: center;
            }
            
            .social-links {
                justify-content: center;
            }

            .contact-item {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .footer {
                padding: 30px 0 15px;
            }
            
            .footer-brand .logo {
                max-width: 120px;
            }
            
            .footer-bottom-links {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>


    <!-- Footer -->
   <!-- Footer -->
   <footer style="background: #333; color: white; padding: 60px 0 20px;">
       <div class="container">
           <div class="row">
               <div class="col-md-4 mb-4">
                   <h5 style="color: #00B894; margin-bottom: 20px;">CariFreelance</h5>
                   <p style="color: #ccc;">Platform terpercaya untuk menghubungkan klien dengan freelancer profesional di Indonesia.</p>
                   <div class="social-links" style="margin-top: 20px;">
                       <a href="#" style="color: #ccc; margin-right: 15px; font-size: 1.2rem;"><i class="fab fa-facebook"></i></a>
                       <a href="#" style="color: #ccc; margin-right: 15px; font-size: 1.2rem;"><i class="fab fa-twitter"></i></a>
                       <a href="#" style="color: #ccc; margin-right: 15px; font-size: 1.2rem;"><i class="fab fa-instagram"></i></a>
                       <a href="#" style="color: #ccc; margin-right: 15px; font-size: 1.2rem;"><i class="fab fa-linkedin"></i></a>
                   </div>
               </div>
               <div class="col-md-2 mb-4">
                   <h6 style="color: white; margin-bottom: 20px;">Kategori</h6>
                   <ul style="list-style: none; padding: 0;">
                       <li style="margin-bottom: 10px;"><a href="#" style="color: #ccc; text-decoration: none;">Web Development</a></li>
                       <li style="margin-bottom: 10px;"><a href="#" style="color: #ccc; text-decoration: none;">Mobile App</a></li>
                       <li style="margin-bottom: 10px;"><a href="#" style="color: #ccc; text-decoration: none;">Grafis Design</a></li>
                       <li style="margin-bottom: 10px;"><a href="#" style="color: #ccc; text-decoration: none;">Digital Marketing</a></li>
                   </ul>
               </div>
               <div class="col-md-2 mb-4">
                   <h6 style="color: white; margin-bottom: 20px;">Dukungan</h6>
                   <ul style="list-style: none; padding: 0;">
                       <li style="margin-bottom: 10px;"><a href="#" style="color: #ccc; text-decoration: none;">Pusat Bantuan</a></li>
                       <li style="margin-bottom: 10px;"><a href="#" style="color: #ccc; text-decoration: none;">FAQ</a></li>
                       <li style="margin-bottom: 10px;"><a href="#" style="color: #ccc; text-decoration: none;">Kontak Kami</a></li>
                       <li style="margin-bottom: 10px;"><a href="#" style="color: #ccc; text-decoration: none;">Live Chat</a></li>
                   </ul>
               </div>
               <div class="col-md-2 mb-4">
                   <h6 style="color: white; margin-bottom: 20px;">Perusahaan</h6>
                   <ul style="list-style: none; padding: 0;">
                       <li style="margin-bottom: 10px;"><a href="#" style="color: #ccc; text-decoration: none;">Tentang Kami</a></li>
                       <li style="margin-bottom: 10px;"><a href="#" style="color: #ccc; text-decoration: none;">Karir</a></li>
                       <li style="margin-bottom: 10px;"><a href="#" style="color: #ccc; text-decoration: none;">Blog</a></li>
                       <li style="margin-bottom: 10px;"><a href="#" style="color: #ccc; text-decoration: none;">Press</a></li>
                   </ul>
               </div>
               <div class="col-md-2 mb-4">
                   <h6 style="color: white; margin-bottom: 20px;">Legal</h6>
                   <ul style="list-style: none; padding: 0;">
                       <li style="margin-bottom: 10px;"><a href="#" style="color: #ccc; text-decoration: none;">Syarat & Ketentuan</a></li>
                       <li style="margin-bottom: 10px;"><a href="#" style="color: #ccc; text-decoration: none;">Kebijakan Privasi</a></li>
                       <li style="margin-bottom: 10px;"><a href="#" style="color: #ccc; text-decoration: none;">Disclaimer</a></li>
                   </ul>
               </div>
           </div>
           <hr style="border-color: #555; margin: 40px 0 20px;">
           <div class="text-center">
               <p style="color: #ccc; margin: 0;">&copy; 2024 CariFreelance. All rights reserved.</p>
           </div>
       </div>
   </footer>

    <script>
        // Smooth hover animations
        document.querySelectorAll('.footer-section ul li a').forEach(link => {
            link.addEventListener('mouseenter', function() {
                this.style.paddingLeft = '5px';
            });
            
            link.addEventListener('mouseleave', function() {
                this.style.paddingLeft = '0';
            });
        });

        // Social media hover effects
        document.querySelectorAll('.social-links a').forEach(link => {
            link.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px) scale(1.1)';
            });
            
            link.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    </script>
</body>
</html>