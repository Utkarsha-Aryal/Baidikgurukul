@extends('frontend.layout2.main2')
<style>
    .g-inner-img {
        height: 250px !Important;
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
            <p>हाम्रो ग्यालेरी छवि पृष्ठ</p>
        </div>
    </div>
    <div class="img_after">
        <img src="{{ asset('frontpanel/assets/images/Mask group.png') }}" alt="">
    </div>
</section>
<div class="gallery-inner-container">
    <div class="container">
        <div class="gallery-inner-wrapper">
            <div class="g-inner-img">
                <img src="assets/image/gallery/galleryr1.png" alt="Sample Image 1"
                    data-src="assets/image/gallery/galleryr1.png">
            </div>
            <div class="g-inner-img">
                <img src="assets/image/gallery/galleryr1.png" alt="Sample Image 2"
                    data-src="assets/image/gallery/galleryr1.png">
            </div>
            <div class="g-inner-img">
                <img src="assets/image/gallery/galleryr1.png" alt="Sample Image 3"
                    data-src="assets/image/gallery/galleryr1.png">
            </div>
            <div class="g-inner-img">
                <img src="assets/image/artworks/cc.JPG" alt="Sample Image 4" data-src="assets/image/artworks/cc.JPG">
            </div>
            <div class="g-inner-img">
                <img src="assets/image/gallery/galleryr1.png" alt="Sample Image 5"
                    data-src="assets/image/gallery/galleryr1.png">
            </div>
            <div class="g-inner-img">
                <img src="assets/image/gallery/galleryr1.png" alt="Sample Image 6"
                    data-src="assets/image/gallery/galleryr1.png">
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <img id="modal-image" alt="Modal Image">
    </div>
</div>
<script>
    // Select modal elements
    const modal = document.getElementById('modal');
    const modalImage = document.getElementById('modal-image');
    const closeBtn = document.querySelector('.close');
    // Function to open the modal
    function openModal(src) {
        modalImage.src = src;
        modal.style.display = 'flex';
    }
    // Function to close the modal
    function closeModal() {
        modal.style.display = 'none';
    }
    // Add event listeners to gallery images
    document.querySelectorAll('.gallery-inner-wrapper .g-inner-img img').forEach(img => {
        img.addEventListener('click', () => {
            const src = img.getAttribute('data-src');
            openModal(src);
        });
    });
    // Close modal on close button click
    closeBtn.addEventListener('click', closeModal);
    // Close modal when clicking outside the image
    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });
</script>

@endsection