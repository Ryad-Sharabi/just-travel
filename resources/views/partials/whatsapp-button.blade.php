<style>
    /* Floating WhatsApp Button */
    .whatsapp-float {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        background: #25D366;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
        z-index: 999;
        transition: all 0.3s ease;
        text-decoration: none;
        color: #ffffff;
        font-size: 1.8rem;
        animation: pulse-whatsapp 2s infinite;
    }

    .whatsapp-float:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 30px rgba(37, 211, 102, 0.6);
    }

    .whatsapp-float:active {
        transform: scale(0.95);
    }

    @keyframes pulse-whatsapp {
        0%, 100% {
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
        }
        50% {
            box-shadow: 0 4px 30px rgba(37, 211, 102, 0.6), 0 0 0 10px rgba(37, 211, 102, 0.1);
        }
    }

    @media (max-width: 768px) {
        .whatsapp-float {
            bottom: 20px;
            right: 20px;
            width: 55px;
            height: 55px;
            font-size: 1.6rem;
        }
    }
</style>

<!-- Floating WhatsApp Button -->
<a href="https://wa.me/971507466975" target="_blank" class="whatsapp-float" aria-label="Contact us on WhatsApp" title="Chat with us on WhatsApp">
    <i class="fa-brands fa-whatsapp"></i>
</a>

