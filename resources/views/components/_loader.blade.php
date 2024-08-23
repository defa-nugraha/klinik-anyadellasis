<style>
    /* CSS untuk loader dan animasi */
    .loader-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .spinner {
        border: 4px solid rgba(0, 0, 0, 0.1);
        border-left-color: #000000;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .bouncing-dots {
        display: flex;
        justify-content: space-between;
        width: 50px;
    }

    .bouncing-dots div {
        width: 10px;
        height: 10px;
        background-color: #cb6ce6;
        border-radius: 50%;
        animation: bounce 1.5s infinite;
    }

    .bouncing-dots div:nth-child(1) {
        animation-delay: 0s;
    }

    .bouncing-dots div:nth-child(2) {
        animation-delay: 0.3s;
    }

    .bouncing-dots div:nth-child(3) {
        animation-delay: 0.6s;
    }

    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-15px);
        }
    }

    .pulsing-circle {
        width: 20px;
        height: 20px;
        background-color: #cb6ce6;
        border-radius: 50%;
        animation: pulse 1.5s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.5);
            opacity: 0.5;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }
</style>

<div class="loader-wrapper" id="loader">
{{-- <div class="spinner"></div> --}}
<div class="bouncing-dots">
    <div></div>
    <div></div>
    <div></div>
</div>
{{-- <div class="pulsing-circle"></div> --}}
</div>