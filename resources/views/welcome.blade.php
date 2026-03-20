<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Google Fonts: Space Grotesk (Navbar) & Poppins (Content) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <style>
        /* Reset & Base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Poppins", sans-serif;
            font-style: normal;
            background-color: #f5f5f5;
        }

        /* Navbar */
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 2rem;
            background-color: #ffffff;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
            font-family: "Space Grotesk", sans-serif;
            font-optical-sizing: auto;
            font-style: normal;
        }

        /* Logo */
        .navbar-logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: #16423C;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .navbar-logo:hover {
            color: #6A9C89;
        }

        /* Nav Menu */
        .nav-menu {
            display: flex;
            align-items: center;
            gap: 2rem;
            list-style: none;
        }

        .nav-link {
            text-decoration: none;
            color: #374151;
            font-size: 1rem;
            font-weight: 400;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #6A9C89, #16423C);
            transition: width 0.3s ease;
        }

        .nav-link:hover {
            color: #16423C;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Nav Buttons */
        .nav-buttons {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .btn {
            padding: 0.625rem 1.25rem;
            font-size: 0.95rem;
            font-weight: 400;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .btn-login {
            background-color: #ffffff;
            color: #1f2937;
        }

        .btn-login:hover {
            background-color: #f9fafb;
            color: #111827;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-daftar {
            background: linear-gradient(135deg, #6A9C89 0%, #16423C 100%);
            color: #ffffff;
            box-shadow: 0 2px 8px rgba(22, 66, 60, 0.3);
        }

        .btn-daftar:hover {
            background: linear-gradient(135deg, #5a8c79 0%, #0f352d 100%);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(22, 66, 60, 0.5);
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            flex-direction: column;
            gap: 5px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.5rem;
        }

        .mobile-menu-toggle span {
            width: 25px;
            height: 3px;
            background-color: #16423C;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        /* Hero Section */
        .hero {
            position: relative;
            height: 100dvh;
            width: 100%;
            overflow: hidden;
            background: linear-gradient(180deg, #f5f5f5 0%, #e8e8e8 100%);
        }

        /* Decorative Images */
        .hero-decor-left {
            position: absolute;
            top: -5%;
            left: -5%;
            width: auto;
            height: 80%;
            max-height: 700px;
            object-fit: contain;
            z-index: 1;
            pointer-events: none;
        }

        .hero-decor-right {
            position: absolute;
            top: 0;
            right: 0;
            width: auto;
            height: 55%;
            max-height: 462px;
            object-fit: contain;
            z-index: 1;
            pointer-events: none;
        }

        /* Hero Content */
        .hero-content {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            padding: 2rem;
        }

        /* Hero Logo Container */
        .hero-logo-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
            margin-top: -10%; /* Move slightly up */
        }

        .hero-logo {
            width: auto;
            height: auto;
            max-width: 367px;
            max-height: 310px;
            object-fit: contain;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #16423C;
            text-align: center;
            letter-spacing: -0.02em;
            font-family: "Poppins", sans-serif;
        }

        .hero-subtitle {
            font-size: 1rem;
            font-weight: 400;
            font-style: italic;
            color: #6B7280;
            text-align: center;
            margin-top: 0.5rem;
            font-family: "Poppins", sans-serif;
            max-width: 500px;
            line-height: 1.6;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                padding: 1rem 1.5rem;
            }

            .nav-menu {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: #ffffff;
                flex-direction: column;
                padding: 1.5rem;
                gap: 1rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            }

            .nav-menu.active {
                display: flex;
            }

            .nav-buttons {
                display: none;
            }

            .mobile-menu-toggle {
                display: flex;
            }

            .mobile-menu-toggle.active span:nth-child(1) {
                transform: rotate(45deg) translate(5px, 5px);
            }

            .mobile-menu-toggle.active span:nth-child(2) {
                opacity: 0;
            }

            .mobile-menu-toggle.active span:nth-child(3) {
                transform: rotate(-45deg) translate(7px, -6px);
            }

            /* Hero Mobile */
            .hero-decor-left {
                left: -15%;
                height: 60%;
                max-height: 450px;
            }

            .hero-decor-right {
                top: 0;
                right: 0;
                height: 40%;
                max-height: 280px;
            }

            .hero-logo-container {
                margin-top: -5%;
            }

            .hero-logo {
                max-width: 250px;
                max-height: 210px;
            }

            .hero-title {
                font-size: 1.75rem;
            }

            .hero-subtitle {
                font-size: 0.875rem;
            }
        }

        @media (max-width: 480px) {
            .hero-decor-left {
                left: -25%;
                height: 30%;
            }

            .hero-decor-right {
                right: -25%;
                height: 25%;
            }

            .hero-logo {
                max-width: 200px;
                max-height: 170px;
            }

            .hero-title {
                font-size: 1.5rem;
            }

            .hero-subtitle {
                font-size: 0.8rem;
            }
        }

        /* Bottom Ornament */
        .hero-bottom-ornament {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: none;
            height: auto;
            min-height: 150px;
            object-fit: cover;
            z-index: 1;
            pointer-events: none;
        }

        @media (max-width: 768px) {
            .hero-bottom-ornament {
                min-height: 100px;
            }
        }

        @media (max-width: 480px) {
            .hero-bottom-ornament {
                min-height: 80px;
            }
        }

        /* Entrance Animations */
        @keyframes slideInFromTop {
            from {
                opacity: 0;
                transform: translateY(-100px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInFromLeft {
            from {
                opacity: 0;
                transform: translateX(-100px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInFromRight {
            from {
                opacity: 0;
                transform: translateX(100px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInFromBottom {
            from {
                opacity: 0;
                transform: translateX(-50%) translateY(100px);
            }
            to {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Animation Classes */
        .hero-logo {
            animation: slideInFromTop 1s cubic-bezier(0.4, 0, 0.2, 1) forwards;
            opacity: 0;
        }

        .hero-title {
            animation: fadeIn 1s cubic-bezier(0.4, 0, 0.2, 1) 0.3s forwards;
            opacity: 0;
        }

        .hero-subtitle {
            animation: fadeIn 1s cubic-bezier(0.4, 0, 0.2, 1) 0.5s forwards;
            opacity: 0;
        }

        .hero-decor-left {
            animation: slideInFromLeft 1.2s cubic-bezier(0.4, 0, 0.2, 1) forwards;
            opacity: 0;
        }

        .hero-decor-right {
            animation: slideInFromRight 1.2s cubic-bezier(0.4, 0, 0.2, 1) forwards;
            opacity: 0;
        }

        .hero-bottom-ornament {
            animation: slideInFromBottom 1s cubic-bezier(0.4, 0, 0.2, 1) 0.2s forwards;
            opacity: 0;
        }

        /* About Section (Apa itu RKM Al-Jannah) */
        .about-section {
            padding: 4rem 2rem;
            background-color: #f5f5f5;
        }

        .about-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .about-box {
            background: linear-gradient(135deg, #1E5A52 0%, #98CBBE 100%);
            border-radius: 16px;
            padding: 2.5rem 3rem;
            box-shadow: 0 10px 40px rgba(30, 90, 82, 0.3);
        }

        .about-title {
            font-family: "Poppins", sans-serif;
            font-size: 1.75rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .about-content {
            font-family: "Poppins", sans-serif;
            font-size: 1.125rem;
            font-weight: 600;
            color: #ffffff;
            text-align: center;
            line-height: 1.8;
            max-width: 900px;
            margin: 0 auto;
        }

        .about-footer {
            font-family: "Poppins", sans-serif;
            font-size: 1.0625rem;
            font-weight: 700;
            color: #396E56;
            text-align: center;
            margin-top: 2rem;
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            .about-section {
                padding: 3rem 1.5rem;
            }

            .about-box {
                padding: 2rem 1.5rem;
            }

            .about-title {
                font-size: 1.5rem;
            }

            .about-content {
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .about-title {
                font-size: 1.25rem;
            }

            .about-content {
                font-size: 0.95rem;
            }
        }

        /* Vision & Mission Section */
        .vision-mission-section {
            padding: 4rem 2rem;
            background-color: #f5f5f5;
        }

        .vision-mission-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }

        .vm-box {
            background: linear-gradient(135deg, #1E5A52 0%, #98CBBE 100%);
            border-radius: 16px;
            padding: 2rem 2.5rem;
            box-shadow: 0 10px 40px rgba(30, 90, 82, 0.3);
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            min-height: 280px;
        }

        .vm-title {
            font-family: "Poppins", sans-serif;
            font-size: 1.75rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 1.25rem;
            text-align: center;
        }

        .vm-content {
            font-family: "Poppins", sans-serif;
            font-size: 1rem;
            font-weight: 600;
            color: #ffffff;
            line-height: 1.8;
        }

        .vm-content.center {
            text-align: center;
        }

        .vm-content ul {
            list-style: none;
            padding-left: 0;
            margin-top: 0.75rem;
        }

        .vm-content ul li {
            position: relative;
            padding-left: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .vm-content ul li::before {
            content: '•';
            position: absolute;
            left: 0;
            color: #ffffff;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .vision-mission-section {
                padding: 3rem 1.5rem;
            }

            .vision-mission-container {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .vm-box {
                padding: 1.75rem 2rem;
                min-height: auto;
            }

            .vm-title {
                font-size: 1.5rem;
            }

            .vm-content {
                font-size: 0.95rem;
            }
        }

        @media (max-width: 480px) {
            .vm-title {
                font-size: 1.25rem;
            }

            .vm-content {
                font-size: 0.9rem;
            }
        }

        /* Scroll Animation for Vision & Mission */
        .vm-box {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1), transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .vm-box.animate {
            opacity: 1;
            transform: translateY(0);
        }

        .vm-title {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1), transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .vm-box.animate .vm-title {
            opacity: 1;
            transform: translateY(0);
        }

        .vm-content,
        .vm-content p,
        .vm-content ul,
        .vm-content ul li {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1), transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .vm-box.animate .vm-content,
        .vm-box.animate .vm-content p,
        .vm-box.animate .vm-content ul,
        .vm-box.animate .vm-content ul li {
            opacity: 1;
            transform: translateY(0);
        }

        /* Stagger delays */
        .vm-box:nth-child(1).animate .vm-title {
            transition-delay: 0.1s;
        }

        .vm-box:nth-child(1).animate .vm-content {
            transition-delay: 0.2s;
        }

        .vm-box:nth-child(2).animate .vm-title {
            transition-delay: 0.2s;
        }

        .vm-box:nth-child(2).animate .vm-content {
            transition-delay: 0.3s;
        }

        .vm-content.animate .vm-content p,
        .vm-content.animate .vm-content ul,
        .vm-content.animate .vm-content ul li {
            opacity: 1;
            transform: translateY(0);
        }

        .vm-content p:nth-child(1) {
            transition-delay: 0.1s;
        }

        .vm-content p:nth-child(2) {
            transition-delay: 0.15s;
        }

        .vm-content ul li:nth-child(1) {
            transition-delay: 0.2s;
        }

        .vm-content ul li:nth-child(2) {
            transition-delay: 0.25s;
        }

        .vm-content ul li:nth-child(3) {
            transition-delay: 0.3s;
        }

        .vm-content p:nth-child(5) {
            transition-delay: 0.35s;
        }

        /* News Section (Kanal Berita) */
        .news-section {
            padding: 4rem 2rem;
            background-color: #f5f5f5;
        }

        .news-container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
        }

        /* News Section (Kanal Berita) */
        .news-section {
            padding: 4rem 2rem;
            background: linear-gradient(180deg, #98CBBE 0%, #1E5A52 100%);
            min-height: 400px;
        }

        .news-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .news-header {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 2rem;
        }

        .news-title {
            font-family: "Poppins", sans-serif;
            font-size: 1.75rem;
            font-weight: 700;
            color: #1E5A52;
            background-color: #ffffff;
            padding: 0.5rem 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .news-content {
            /* Custom Row System */
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            padding-bottom: 1.5rem;
            margin: 0;
        }

        /* Column System - Similar to Bootstrap */
        .news-content .news-col {
            flex: 0 0 calc(33.333333% - 1rem);
            max-width: calc(33.333333% - 1rem);
        }

        /* Responsive Columns */
        @media (max-width: 1024px) {
            .news-content .news-col {
                flex: 0 0 calc(50% - 0.75rem);
                max-width: calc(50% - 0.75rem);
            }
        }

        @media (max-width: 768px) {
            .news-content .news-col {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        /* Hide cards with data-hidden="true" */
        .news-content .news-col[data-hidden="true"] {
            display: none !important;
        }

        .news-footer {
            display: flex;
            justify-content: center;
            padding-top: 1.5rem;
        }

        .btn-see-all {
            font-family: "Poppins", sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            color: #1E5A52;
            background-color: #ffffff;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-see-all:hover {
            background-color: #f8f9fa;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .news-content {
            /* Placeholder for news cards */
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 250px;
            color: rgba(255, 255, 255, 0.8);
            font-family: "Poppins", sans-serif;
            font-size: 1.125rem;
        }

        @media (max-width: 768px) {
            .news-section {
                padding: 3rem 1.5rem;
            }

            .news-wrapper {
                padding: 2rem 1.5rem;
            }

            .news-header {
                top: -2.5rem;
            }

            .news-title {
                font-size: 1.5rem;
                padding: 0.5rem 1.5rem;
            }

            .news-content {
                grid-template-columns: 1fr;
            }

            .btn-see-all {
                width: 100%;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .news-header {
                top: -2rem;
            }

            .news-title {
                font-size: 1.25rem;
                padding: 0.5rem 1rem;
            }
        }

        /* Contact Section (Hubungi Kami) */
        .contact-section {
            padding: 4rem 2rem;
            background: linear-gradient(180deg, #98CBBE 0%, #1E5A52 100%);
            min-height: 400px;
        }

        .contact-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .contact-header {
            display: flex;
            justify-content: center;
            margin-bottom: 3rem;
        }

        .contact-title {
            font-family: "Poppins", sans-serif;
            font-size: 1.75rem;
            font-weight: 700;
            color: #1E5A52;
            background-color: #ffffff;
            padding: 0.5rem 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 0;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .contact-card {
            background-color: #ffffff;
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 4px 15px rgba(22, 66, 60, 0.3);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(22, 66, 60, 0.5);
        }

        .contact-icon {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, #6A9C89 0%, #16423C 100%);
            border-radius: 50%;
            color: #ffffff;
        }

        .contact-card-title {
            font-family: "Poppins", sans-serif;
            font-size: 1.25rem;
            font-weight: 700;
            color: #16423C;
            margin-bottom: 1rem;
        }

        .contact-card-text {
            font-family: "Poppins", sans-serif;
            font-size: 1rem;
            font-weight: 400;
            color: #374151;
            line-height: 1.8;
        }

        .contact-card-text a {
            color: #16423C;
            text-decoration: none;
            transition: opacity 0.3s ease;
        }

        .contact-card-text a:hover {
            opacity: 0.8;
            text-decoration: underline;
        }

        /* Benefits Section (Keuntungan) */
        .benefits-section {
            padding: 4rem 2rem;
            background-color: #ffffff;
            min-height: 400px;
        }

        .benefits-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .benefits-title {
            font-family: "Poppins", sans-serif;
            font-size: 1.75rem;
            font-weight: 700;
            color: #1E5A52;
            text-align: center;
            margin-bottom: 3rem;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }

        .benefits-card {
            background: linear-gradient(135deg, #6A9C89 0%, #16423C 100%);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(22, 66, 60, 0.3);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .benefits-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(22, 66, 60, 0.5);
        }

        .benefits-card-icon {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 70px;
            height: 70px;
            background-color: #ffffff;
            border-radius: 50%;
            color: #16423C;
            margin: 0 auto 0.5rem;
        }

        .benefits-card-title {
            font-family: "Poppins", sans-serif;
            font-size: 1.25rem;
            font-weight: 700;
            color: #ffffff;
            text-align: center;
        }

        .benefits-card-text {
            font-family: "Poppins", sans-serif;
            font-size: 0.95rem;
            font-weight: 400;
            color: #ffffff;
            line-height: 1.8;
            text-align: center;
            flex: 1;
        }

        /* Member Benefits Section */
        .member-benefits-section {
            padding: 4rem 2rem;
            background-color: #ffffff;
        }

        .member-benefits-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .member-benefits-title {
            font-family: "Poppins", sans-serif;
            font-size: 1.75rem;
            font-weight: 700;
            color: #1E5A52;
            text-align: center;
            margin-bottom: 3rem;
        }

        .member-benefits-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }

        .member-benefits-card {
            background-color: #ffffff;
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            border: 2px solid #16423C;
            box-shadow: 0 4px 15px rgba(22, 66, 60, 0.2);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .member-benefits-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(22, 66, 60, 0.4);
        }

        .member-benefits-image {
            width: 100%;
            height: 200px;
            object-fit: contain;
            margin-bottom: 1.5rem;
        }

        .member-benefits-card-title {
            font-family: "Poppins", sans-serif;
            font-size: 1.125rem;
            font-weight: 700;
            color: #16423C;
        }

        @media (max-width: 1024px) {
            .member-benefits-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .member-benefits-section {
                padding: 3rem 1.5rem;
            }

            .member-benefits-grid {
                grid-template-columns: 1fr;
            }

            .member-benefits-title {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .member-benefits-title {
                font-size: 1.25rem;
            }

            .member-benefits-card {
                padding: 1.5rem;
            }

            .member-benefits-image {
                height: 150px;
            }

            .member-benefits-card-title {
                font-size: 1rem;
            }
        }

        @media (max-width: 1024px) {
            .benefits-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .benefits-section {
                padding: 3rem 1.5rem;
            }

            .benefits-grid {
                grid-template-columns: 1fr;
            }

            .benefits-title {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .benefits-title {
                font-size: 1.25rem;
            }

            .benefits-card {
                padding: 1.5rem;
            }

            .benefits-card-icon {
                width: 60px;
                height: 60px;
            }

            .benefits-card-title {
                font-size: 1.125rem;
            }

            .benefits-card-text {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 1024px) {
            .contact-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .contact-section {
                padding: 3rem 1.5rem;
            }

            .contact-grid {
                grid-template-columns: 1fr;
            }

            .contact-title {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .contact-title {
                font-size: 1.25rem;
            }

            .contact-card {
                padding: 1.5rem;
            }

            .contact-icon {
                width: 60px;
                height: 60px;
            }
        }

        /* Footer */
        .footer {
            background: linear-gradient(180deg, #16423C 0%, #0d2b26 100%);
            padding: 2rem;
            margin-top: 0;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2rem;
        }

        .footer-brand-title {
            font-family: "Poppins", sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0.25rem;
        }

        .footer-brand-text {
            font-family: "Poppins", sans-serif;
            font-size: 0.875rem;
            font-weight: 400;
            color: rgba(255, 255, 255, 0.7);
        }

        .footer-divider {
            width: 1px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.3);
        }

        .footer-developer-text {
            font-family: "Poppins", sans-serif;
            font-size: 0.875rem;
            font-weight: 400;
            color: rgba(255, 255, 255, 0.7);
        }

        .footer-developer-name {
            font-weight: 600;
            color: #98CBBE;
        }

        @media (max-width: 768px) {
            .footer-content {
                flex-direction: column;
                text-align: center;
            }

            .footer-divider {
                width: 100%;
                height: 1px;
            }

            .footer {
                padding: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .footer-brand-title {
                font-size: 1.25rem;
            }

            .footer {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar Component -->
    <x-navbar />

    <!-- Hero Section -->
    <section class="hero">
        <!-- Decorative Images -->
        <img src="{{ asset('images/ranting.png') }}" alt="Decorative branch" class="hero-decor-left">
        <img src="{{ asset('images/pohon.png') }}" alt="Decorative tree" class="hero-decor-right">

        <!-- Hero Content -->
        <div class="hero-content">
            <div class="hero-logo-container">
                <img src="{{ asset('images/logo-al-jannah.png') }}" alt="RKM Al-Jannah Logo" class="hero-logo">
                <h1 class="hero-title">RKM Al-Jannah</h1>
                <p class="hero-subtitle">Bersama dalam Kepedulian, Hadir saat Masa Duka dengan Amanah dan Transparan</p>
            </div>
        </div>

        <!-- Bottom Ornament -->
        <img src="{{ asset('images/bottom-ornament.png') }}" alt="Bottom ornament" class="hero-bottom-ornament">
    </section>

    <!-- About Section (Apa itu RKM Al-Jannah) -->
    <section class="about-section" id="visi-misi">
        <div class="about-container">
            <div class="about-box">
                <h2 class="about-title">Apa itu RKM AL JANNAH ?</h2>
                <p class="about-content">
                    Rukun Kematian (RKM) AL Jannah adalah bentuk kerjasama antara yayasan Sa'ad Bin Abi Waqqosh dengan sanggar Ma'e, sebagai tanda bakti kepada masyarakat dalam memberikan pertolongan kepada anggota Rukun Kematian yang meninggal dunia yang sesuai Sunnah (tata cara yang rosululloh shallallahu Aalaihi wasallam ajarkan).
                </p>
            </div>
            <p class="about-footer">
                Berdiri sejak: 2017<br>
                Di bawah naungan Yayasan Sa'ad Bin Abi Waqqash
            </p>
        </div>
    </section>

    <!-- Vision & Mission Section -->
    <section class="vision-mission-section">
        <div class="vision-mission-container">
            <!-- Visi Box -->
            <article class="vm-box">
                <h2 class="vm-title">Visi</h2>
                <p class="vm-content center">
                    Rukun kematian yang mampu mengangkat harkat dan martabat keluarga anggotanya yang meninggal dunia.
                </p>
            </article>

            <!-- Misi Box -->
            <article class="vm-box">
                <h2 class="vm-title">Misi</h2>
                <div class="vm-content">
                    <p>1. Memberikan pertolongan yang adil dan merata bagi seluruh anggota RKM.</p>
                    <p>Pertolongan yang dimaksud adalah:</p>
                    <ul>
                        <li>Bantuan materi</li>
                        <li>Bantuan Tenaga</li>
                        <li>Bantuan Jasa</li>
                    </ul>
                    <p>2. Membantu masyarakat yang membutuhkan bantuan dalam hal kepengurusan jenazah</p>
                </div>
            </article>
        </div>
    </section>

    <!-- News Section (Kanal Berita) -->
    <section class="news-section" id="kanal-berita">
        <div class="news-container">
            <div class="news-header">
                <h2 class="news-title">Kanal Berita</h2>
            </div>
            <div class="news-content" id="newsContent">
                    <!-- Row 1 -->
                    <div class="news-col">
                        <x-news-card 
                            image="https://images.unsplash.com/photo-1585829365295-ab7cd400c167?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80"
                            :tags="['Berita', 'Kegiatan']"
                            title="Kegiatan Rutin RKM Al-Jannah Bulan Ini"
                            url="/berita/kegiatan-rutin-rkm-al-jannah-bulan-ini"
                        />
                    </div>
                    <div class="news-col">
                        <x-news-card 
                            image="https://images.unsplash.com/photo-1577962917302-cd874c4e31d2?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80"
                            :tags="['Pengumuman']"
                            title="Pengumuman Penting Untuk Anggota Baru"
                            url="#berita-2"
                        />
                    </div>
                    <div class="news-col">
                        <x-news-card 
                            image="https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80"
                            :tags="['Berita', 'Sosial']"
                            title="Bantuan Kematian Untuk Keluarga Anggota"
                            url="#berita-3"
                        />
                    </div>

                    <!-- Row 2 -->
                    <div class="news-col">
                        <x-news-card 
                            image="https://images.unsplash.com/photo-1551818255-e6e10975bc17?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80"
                            :tags="['Kegiatan']"
                            title="Rapat Koordinasi Bulanan Pengurus"
                            url="#berita-4"
                        />
                    </div>
                    <div class="news-col">
                        <x-news-card 
                            image="https://images.unsplash.com/photo-1521791136064-7986c2920216?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80"
                            :tags="['Berita', 'Edukasi']"
                            title="Sosialisasi Tata Cara Pengurusan Jenazah"
                            url="#berita-5"
                        />
                    </div>
                    <div class="news-col">
                        <x-news-card 
                            image="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80"
                            :tags="['Pengumuman']"
                            title="Jadwal Piket Minggu Ini"
                            url="#berita-6"
                        />
                    </div>

                    <!-- Row 3 (Hidden initially) -->
                    <div class="news-col" data-hidden="true">
                        <x-news-card 
                            image="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80"
                            :tags="['Berita']"
                            title="Penyaluran Bantuan Untuk Keluarga Terdampak"
                            url="#berita-7"
                        />
                    </div>
                    <div class="news-col" data-hidden="true">
                        <x-news-card 
                            image="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80"
                            :tags="['Kegiatan', 'Sosial']"
                            title="Bakti Sosial RKM Al-Jannah"
                            url="#berita-8"
                        />
                    </div>
                    <div class="news-col" data-hidden="true">
                        <x-news-card 
                            image="https://images.unsplash.com/photo-1531482615713-2afd69097998?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80"
                            :tags="['Edukasi']"
                            title="Workshop Manajemen Organisasi"
                            url="#berita-9"
                        />
                    </div>

                    <!-- Row 4 (Hidden initially) -->
                    <div class="news-col" data-hidden="true">
                        <x-news-card 
                            image="https://images.unsplash.com/photo-1517048676732-d65bc937f952?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80"
                            :tags="['Berita', 'Pengumuman']"
                            title="Update Sistem Informasi Anggota"
                            url="#berita-10"
                        />
                    </div>
                    <div class="news-col" data-hidden="true">
                        <x-news-card 
                            image="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80"
                            :tags="['Kegiatan']"
                            title="Pelatihan Relawan Baru"
                            url="#berita-11"
                        />
                    </div>
                    <div class="news-col" data-hidden="true">
                        <x-news-card 
                            image="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80"
                            :tags="['Berita']"
                            title="Laporan Keuangan Semester 1"
                            url="#berita-12"
                        />
                    </div>

                    <!-- Row 5 (Hidden initially) -->
                    <div class="news-col" data-hidden="true">
                        <x-news-card 
                            image="https://images.unsplash.com/photo-1577962917302-cd874c4e31d2?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80"
                            :tags="['Pengumuman']"
                            title="Perubahan Jadwal Kegiatan"
                            url="#berita-13"
                        />
                    </div>
                    <div class="news-col" data-hidden="true">
                        <x-news-card 
                            image="https://images.unsplash.com/photo-1585829365295-ab7cd400c167?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80"
                            :tags="['Berita', 'Kegiatan']"
                            title="Kunjungan Dari Organisasi Mitra"
                            url="#berita-14"
                        />
                    </div>
                    <div class="news-col" data-hidden="true">
                        <x-news-card 
                            image="https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80"
                            :tags="['Sosial']"
                            title="Penyerahan Bantuan Akhir Tahun"
                            url="#berita-15"
                        />
                    </div>

                    <!-- Row 6 (Hidden initially) -->
                    <div class="news-col" data-hidden="true">
                        <x-news-card 
                            image="https://images.unsplash.com/photo-1551818255-e6e10975bc17?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80"
                            :tags="['Berita']"
                            title="Evaluasi Program Kerja 2026"
                            url="#berita-16"
                        />
                    </div>
                    <div class="news-col" data-hidden="true">
                        <x-news-card 
                            image="https://images.unsplash.com/photo-1521791136064-7986c2920216?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80"
                            :tags="['Edukasi', 'Kegiatan']"
                            title="Seminar Kesehatan Mental"
                            url="#berita-17"
                        />
                    </div>
                    <div class="news-col" data-hidden="true">
                        <x-news-card 
                            image="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80"
                            :tags="['Pengumuman']"
                            title="Pendaftaran Anggota Baru Dibuka"
                            url="#berita-18"
                        />
                    </div>

                    <!-- Row 7 (Hidden initially) -->
                    <div class="news-col" data-hidden="true">
                        <x-news-card 
                            image="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80"
                            :tags="['Berita', 'Sosial']"
                            title="Program Beasiswa Untuk Yatim"
                            url="#berita-19"
                        />
                    </div>
                    <div class="news-col" data-hidden="true">
                        <x-news-card 
                            image="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80"
                            :tags="['Kegiatan']"
                            title="Gathering Anggota Tahunan"
                            url="#berita-20"
                        />
                    </div>
                </div>
                <div class="news-footer">
                    <a href="#semua-berita" class="btn-see-all">Lihat Selengkapnya</a>
                </div>
        </div>
    </section>

    <!-- Benefits Section (Layanan & Keuntungan) -->
    <section class="benefits-section" id="layanan-keuntungan">
        <div class="benefits-container">
            <h2 class="benefits-title">Layanan Kami</h2>
            <div class="benefits-grid">
                <!-- Card 1: Perawatan Jenazah -->
                <div class="benefits-card">
                    <div class="benefits-card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </div>
                    <h3 class="benefits-card-title">Perawatan Jenazah</h3>
                    <p class="benefits-card-text">
                        Melaksanakan proses pemulasaraan jenazah sesuai syariat Islam, meliputi pemandian dan perawatan jenazah oleh petugas yang telah ditetapkan.
                    </p>
                </div>

                <!-- Card 2: Pengafanan -->
                <div class="benefits-card">
                    <div class="benefits-card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="6" cy="6" r="3"></circle>
                            <circle cx="6" cy="18" r="3"></circle>
                            <line x1="20" y1="4" x2="8.12" y2="15.88"></line>
                            <line x1="14.47" y1="14.48" x2="20" y2="20"></line>
                            <line x1="8.12" y1="8.12" x2="12" y2="12"></line>
                        </svg>
                    </div>
                    <h3 class="benefits-card-title">Pengafanan</h3>
                    <p class="benefits-card-text">
                        Menyediakan 1 (satu) set perlengkapan kain kafan lengkap beserta kebutuhan lainnya, serta pelaksanaan pengafanan sesuai tuntunan syariat.
                    </p>
                </div>

                <!-- Card 3: Ambulance -->
                <div class="benefits-card">
                    <div class="benefits-card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="1" y="3" width="15" height="13"></rect>
                            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                            <circle cx="5.5" cy="18.5" r="2.5"></circle>
                            <circle cx="18.5" cy="18.5" r="2.5"></circle>
                        </svg>
                    </div>
                    <h3 class="benefits-card-title">Ambulance</h3>
                    <p class="benefits-card-text">
                        Menyediakan layanan mobil ambulance untuk pengantaran jenazah ke tempat pemakaman dengan pengaturan jadwal dan rute yang terkoordinasi.
                    </p>
                </div>

                <!-- Card 4: Pemakaman -->
                <div class="benefits-card">
                    <div class="benefits-card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 21h18"></path>
                            <path d="M5 21V7l8-4 8 4v14"></path>
                            <path d="M17 21v-8.5a1.5 1.5 0 0 0-3 0V21"></path>
                        </svg>
                    </div>
                    <h3 class="benefits-card-title">Pemakaman</h3>
                    <p class="benefits-card-text">
                        Mengatur dan mendampingi pelaksanaan sholat jenazah serta proses pemakaman hingga selesai sesuai ketentuan yang berlaku.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Member Benefits Section (Keuntungan Anggota) -->
    <section class="member-benefits-section">
        <div class="member-benefits-container">
            <h2 class="member-benefits-title">Keuntungan Anggota</h2>
            <div class="member-benefits-grid">
                <!-- Card 1: Santunan -->
                <div class="member-benefits-card">
                    <img src="{{ asset('images/keuntungan/santunan.png') }}" alt="Santunan" class="member-benefits-image">
                    <h3 class="member-benefits-card-title">Santunan</h3>
                </div>

                <!-- Card 2: Paket Pengurusan Jenazah -->
                <div class="member-benefits-card">
                    <img src="{{ asset('images/keuntungan/paket-pengurusan-jenazah.png') }}" alt="Paket Pengurusan Jenazah" class="member-benefits-image">
                    <h3 class="member-benefits-card-title">Paket Pengurusan Jenazah</h3>
                </div>

                <!-- Card 3: Hak Suara dalam Rapat -->
                <div class="member-benefits-card">
                    <img src="{{ asset('images/keuntungan/hak-suara.png') }}" alt="Hak Suara dalam Rapat" class="member-benefits-image">
                    <h3 class="member-benefits-card-title">Hak Suara dalam Rapat</h3>
                </div>

                <!-- Card 4: Pelayanan Setara -->
                <div class="member-benefits-card">
                    <img src="{{ asset('images/keuntungan/pelayanan-setara.png') }}" alt="Pelayanan Setara" class="member-benefits-image">
                    <h3 class="member-benefits-card-title">Pelayanan Setara</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section (Hubungi Kami) -->
    <section class="contact-section" id="hubungi-kami">
        <div class="contact-container">
            <div class="contact-header">
                <h2 class="contact-title">Hubungi Kami</h2>
            </div>
            <div class="contact-grid">
                <div class="contact-card">
                    <div class="contact-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                    </div>
                    <h3 class="contact-card-title">Alamat</h3>
                    <p class="contact-card-text">
                        Yayasan Sa'ad Bin Abi Waqqosh<br>
                        Sanggar Ma'e<br>
                        Indonesia
                    </p>
                </div>

                <div class="contact-card">
                    <div class="contact-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </div>
                    <h3 class="contact-card-title">Email</h3>
                    <p class="contact-card-text">
                        <a href="mailto:info@aljannah.org">info@aljannah.org</a>
                    </p>
                </div>

                <div class="contact-card">
                    <div class="contact-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                    </div>
                    <h3 class="contact-card-title">Telepon</h3>
                    <p class="contact-card-text">
                        <a href="tel:+6281234567890">+62 812-3456-7890</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Component -->
    <x-footer />

    <!-- Script untuk Mobile Menu -->
    <script>
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const navMenu = document.getElementById('navMenu');

        mobileMenuToggle.addEventListener('click', () => {
            mobileMenuToggle.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        // Close menu when clicking on a link
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenuToggle.classList.remove('active');
                navMenu.classList.remove('active');
            });
        });

        // Scroll Animation for Vision & Mission Section
        const visionMissionSection = document.querySelector('.vision-mission-section');
        const vmBoxes = document.querySelectorAll('.vm-box');

        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.35
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    vmBoxes.forEach((box, index) => {
                        setTimeout(() => {
                            box.classList.add('animate');
                        }, index * 100);
                    });
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        if (visionMissionSection) {
            observer.observe(visionMissionSection);
        }

        // News Cards Pagination - Row System (3 rows per click)
        document.addEventListener('DOMContentLoaded', function() {
            const newsContent = document.getElementById('newsContent');
            const btnSeeAll = document.querySelector('.btn-see-all');
            
            if (!newsContent || !btnSeeAll) return;
            
            const cardsPerRow = 3;
            const rowsPerClick = 3; // Show 3 rows (9 cards) per click
            const initialRows = 2; // Start with 2 rows (6 cards)
            
            let currentRows = initialRows;
            
            function updateVisibility() {
                const allCols = newsContent.querySelectorAll('.news-col');
                const totalCols = allCols.length;
                const maxVisible = currentRows * cardsPerRow;
                
                let visibleCount = 0;
                
                allCols.forEach((col, index) => {
                    if (index < maxVisible) {
                        col.setAttribute('data-hidden', 'false');
                        visibleCount++;
                    } else {
                        col.setAttribute('data-hidden', 'true');
                    }
                });
                
                // Update button text
                if (visibleCount < totalCols) {
                    btnSeeAll.textContent = 'Lihat Selengkapnya';
                } else {
                    btnSeeAll.textContent = 'Tutup';
                }
            }
            
            btnSeeAll.addEventListener('click', function(e) {
                e.preventDefault();
                
                const allCols = newsContent.querySelectorAll('.news-col');
                const totalCols = allCols.length;
                const currentVisibleCount = currentRows * cardsPerRow;
                
                // Check if we should close
                if (currentVisibleCount >= totalCols) {
                    // Close - back to initial 2 rows
                    currentRows = initialRows;
                } else {
                    // Show more - add 3 rows (9 cards)
                    currentRows += rowsPerClick;
                    
                    // Don't exceed total cards
                    if (currentRows * cardsPerRow > totalCols) {
                        currentRows = Math.ceil(totalCols / cardsPerRow);
                    }
                }
                
                updateVisibility();
                
                // Smooth scroll if showing more
                if (currentRows * cardsPerRow <= totalCols) {
                    setTimeout(() => {
                        newsContent.scrollIntoView({ behavior: 'smooth', block: 'end' });
                    }, 100);
                }
            });
            
            // Initialize
            updateVisibility();
        });

        // Register Service Worker for Image Caching
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then((registration) => {
                        console.log('Service Worker registered successfully:', registration.scope);
                    })
                    .catch((error) => {
                        console.log('Service Worker registration failed:', error);
                    });
            });
        }
    </script>
</body>
</html>
