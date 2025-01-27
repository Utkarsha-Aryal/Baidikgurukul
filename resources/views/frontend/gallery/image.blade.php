@extends('frontend.layout2.main2')

<style>
    /* Styling for gallery images */
    .g-inner-img {
        width: calc(33.333% - 20px);

    }

    .g-inner-img img {
        width: 100%;
        height: auto;
        /* Maintain aspect ratio */
        border-radius: 5px;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .g-inner-img img:hover {
        transform: scale(1.05);
    }

    /* Responsive layout for the gallery */
    @media (max-width: 1024px) {
        .g-inner-img {
            width: calc(50% - 20px);
            /* 2 columns on tablets */
        }
    }

    @media (max-width: 768px) {
        .g-inner-img {
            width: calc(100% - 20px);
            /* 1 column on mobile */
        }
    }

    /* Modal styling */
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        padding: 10px;
        /* Add padding for small screens */
        box-sizing: border-box;
    }

    .modal-content {
        position: relative;
        max-width: 90%;
        max-height: 90%;
    }

    #modal-image {
        width: 100%;
        height: auto;
        border-radius: 10px;
        height: 360px;
    }

    .nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        padding: 10px 15px;
        cursor: pointer;
        font-size: 18px;
        z-index: 1001;
    }

    .prev {
        left: 0;
    }

    .next {
        right: 0;
    }

    .close {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 30px;
        color: white;
        cursor: pointer;
        z-index: 1001;
    }

    /* Adjust modal navigation buttons for smaller screens */
    @media (max-width: 768px) {
        .nav-btn {
            font-size: 16px;
            padding: 8px 12px;
        }

        .close {
            font-size: 24px;
        }
    }
</style>

@section('title', 'Our Gallery Inner')

@section('content2')
<section class="introduction_page">
    <div class="img_before">
        <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
    </div>
    <div class="common_image_txt">
        <div class="common_bg_wrapper">
            <img src="{{ asset('frontpanel/assets/images/image1.jpeg') }}" alt="">
        </div>
        <div class="main_txt">
            <p> ग्यालेरी</p>
        </div>
    </div>
    <div class="img_after">
        <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
    </div>
</section>

<div class="gallery-inner-container">
    <div class="container">
        <div class="gallery-inner-wrapper" style="display: flex; flex-wrap: wrap;">
            @foreach ($images as $image)
            <div class="g-inner-img">
                @if (!empty($image->image) && Storage::exists('public/gallery-image/' . $image->image))
                <img src="{{ asset('storage/gallery-image/' . $image->image) }}" alt="Gallery Image" data-src="{{ asset('storage/gallery-image/' . $image->image) }}">
                @else
                <img src="{{ asset('frontpanel/assets/images/placeholder.png') }}" alt="Default Image" data-src="{{ asset('frontpanel/assets/images/placeholder.png') }}">
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <button class="nav-btn prev">&laquo;</button>
        <img id="modal-image" alt="Modal Image">
        <button class="nav-btn next">&raquo;</button>
    </div>
</div>

 <script>
    const modal = document.getElementById('modal');
    const modalImage = document.getElementById('modal-image');
    const closeBtn = document.querySelector('.close');
    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');
    const images = Array.from(document.querySelectorAll('.gallery-inner-wrapper .g-inner-img img'));
    let currentIndex = 0;

    // Swipe variables
    let touchStartX = 0;
    let touchEndX = 0;

    // Function to open the modal
    function openModal(index) {
        currentIndex = index;
        modalImage.src = images[currentIndex].getAttribute('data-src');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden'; // Prevent background scroll
    }

    // Function to close the modal
    function closeModal() {
        modal.style.display = 'none';
        document.body.style.overflow = ''; // Re-enable background scroll
    }

    // Function to show the previous image
    function showPrevImage() {
        currentIndex = (currentIndex - 1 + images.length) % images.length; // Loop back to last if at the start
        modalImage.src = images[currentIndex].getAttribute('data-src');
    }

    // Function to show the next image
    function showNextImage() {
        currentIndex = (currentIndex + 1) % images.length; // Loop back to first if at the end
        modalImage.src = images[currentIndex].getAttribute('data-src');
    }

    // Add event listeners to gallery images
    images.forEach((img, index) => {
        img.addEventListener('click', () => {
            openModal(index);
        });
    });

    // Close modal on close button click
    closeBtn.addEventListener('click', closeModal);

    // Close modal when clicking outside the image
    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });

    // Add event listeners to navigation buttons
    prevBtn.addEventListener('click', showPrevImage);
    nextBtn.addEventListener('click', showNextImage);

    // Add swipe functionality
    modal.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
    });
    modal.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    });

    function handleSwipe() {
        if (touchStartX - touchEndX > 50) {
            // Swipe left: show next image
            showNextImage();
        } else if (touchEndX - touchStartX > 50) {
            // Swipe right: show previous image
            showPrevImage();
        }
    }

    // Keyboard navigation (left and right arrow keys)
    document.addEventListener('keydown', (e) => {
        if (modal.style.display === 'flex') {
            if (e.key === 'ArrowLeft') {
                showPrevImage();
            } else if (e.key === 'ArrowRight') {
                showNextImage();
            } else if (e.key === 'Escape') {
                closeModal();
            }
        }
    });
</script>
@endsection