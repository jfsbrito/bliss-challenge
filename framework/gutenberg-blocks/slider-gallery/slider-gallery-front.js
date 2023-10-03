// Slider for Gutenberg Block
class Slider {
    constructor() {
        // Initialize class properties with elements from the HTML
        this.slider = document.querySelector(".bc-slider");
        if(!this.slider) return;
        this.content = this.slider.querySelector(".bc-slider__content");
        this.images = this.content.querySelectorAll("img");
        this.pager = this.slider.querySelector(".bc-slider__pager");
        this.currentImageIndex = 1; // Set to 1 since the second image is initially displayed
        this.isDragging = false;
        this.dragStartX = 0;
        this.autoSlideInterval = null;

        // Initialize the slider
        this.init();
    }

    // Initialization method
    init() {
        // Show the initial image
        this.showImage(this.currentImageIndex);

        // Create the pager buttons dynamically
        this.createPager();

        // Add event listeners for user interaction and auto-slide
        this.addEventListeners();
        
        // Start auto-slide
        this.startAutoSlide();
    }

    // Method to display an image at a given index
    showImage(index) {
        const translateX = -index * 100; // Translate the content to show the desired image
        this.content.style.transform = `translateX(${translateX}%)`;
    }

    // Method to change the currently displayed image
    changeImage(index) {
        this.currentImageIndex = index;
        this.showImage(this.currentImageIndex);
        this.updatePager();
    }

    // Method to create pager buttons
    createPager() {
        this.images.forEach((img, i) => {
            const button = document.createElement("button");
            button.textContent = i + 1;
            button.classList.add("slide-btn");
            button.addEventListener("click", () => {
                this.changeImage(i);
            });
            this.pager.appendChild(button);
        });

        // Set the initially active button
        this.pager.children[this.currentImageIndex].classList.add("active");
    }

    // Method to update the active button in the pager
    updatePager() {
        const activeButton = this.pager.querySelector(".active");
        if (activeButton) {
            activeButton.classList.remove("active");
        }
        this.pager.children[this.currentImageIndex].classList.add("active");
    }

    // Event handler for drag start
    handleDragStart(event) {
        this.isDragging = true;
        this.dragStartX = event.clientX;
        this.slider.style.cursor = "grabbing";
        clearInterval(this.autoSlideInterval);
    }

    // Event handler for drag move
    handleDragMove(event) {
        if (!this.isDragging) return;

        const offsetX = event.clientX - this.dragStartX;
        const translateX = -this.currentImageIndex * 100 + (offsetX / this.slider.clientWidth) * 100;
        this.content.style.transform = `translateX(${translateX}%)`;
    }

    // Event handler for drag end
    handleDragEnd(event) {
        if (!this.isDragging) return;

        this.slider.style.cursor = "grab";

        // Determine if the user swiped to the next/previous image
        const deltaX = event.clientX - this.dragStartX;
        if (deltaX > 50 && this.currentImageIndex > 0) {
            this.changeImage(this.currentImageIndex - 1);
        } else if (deltaX < -50 && this.currentImageIndex < this.images.length - 1) {
            this.changeImage(this.currentImageIndex + 1);
        } else {
            this.showImage(this.currentImageIndex);
        }

        this.isDragging = false;
        this.startAutoSlide();
    }

    // Method to start auto-slide
    startAutoSlide() {
        clearInterval(this.autoSlideInterval);
        this.autoSlideInterval = setInterval(() => {
            const nextIndex = (this.currentImageIndex + 1) % this.images.length;
            this.changeImage(nextIndex);
        }, 3000);
    }

    // Method to add event listeners
    addEventListeners() {
        this.slider.addEventListener("mousedown", (event) => this.handleDragStart(event));
        this.slider.addEventListener("mousemove", (event) => this.handleDragMove(event));
        this.slider.addEventListener("mouseup", (event) => this.handleDragEnd(event));
        this.slider.addEventListener("mouseleave", (event) => this.handleDragEnd(event));
    }
}

// Initialize the slider when the DOM is fully loaded
document.addEventListener("DOMContentLoaded", function () {
    new Slider();
});
