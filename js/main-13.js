////////////////////

////////////////MAIL JS////////////////////
emailjs.init('h4AhsFG7Qvdnthqgk');

document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting via the browser

    // Fetch form values
    const formData = {
        name: this.name.value,
        email: this.email.value,
        subject: this.subject.value,
        message: this.message.value
    };

    // Send email using MailJS
    const form = document.getElementById('contactForm');
    if (form.checkValidity()) {
      emailjs.send('service_56ecruk', 'template_kz34zom', formData)
        .then(function(response) {
          console.log('Email sent successfully:', response);
          alert('Your message has been sent successfully!');
          form.reset();
        })
        .catch(function(error) {
          console.error('Error sending email:', error);
          alert('There was an error sending your message. Please try again later.');
        });
    } else {
      alert('Please fill in the form before sending.');
    }
});

///////////////////clothing////////////////////////
function toggleImage(element, showBack) {
  const frontImage = element.querySelector('.front-image');
  const backImage = element.querySelector('.back-image');
  if (showBack) {
    gsap.to(frontImage, { opacity: 0, duration: 0.3, ease: "power1.out", onComplete: () => {
      frontImage.style.display = 'none';
      backImage.style.display = 'block';
      gsap.fromTo(backImage, { opacity: 0 }, { opacity: 1, duration: 0.3, ease: "power1.out", delay: 0.5 }); // Add a delay of 0.5 seconds
    }});
  } else {
    gsap.to(backImage, { opacity: 0, duration: 0.3, ease: "power1.out", onComplete: () => {
      backImage.style.display = 'none';
      frontImage.style.display = 'block';
      gsap.fromTo(frontImage, { opacity: 0 }, { opacity: 1, duration: 0.3, ease: "power1.out", delay: 0.5 }); // Add a delay of 0.5 seconds
    }});
  }
}

/////////////////////item////////////////////////


////////////////MUSIC////////////////
window.addEventListener('DOMContentLoaded', function() {
  var audio = new Audio('assets/img/Skeletrix Island 4.mp3'); // replace with the actual path to your audio file
  var audioControl = document.getElementById('audioControl');
  var audioIcon = document.getElementById('audioIcon');

  audioControl.addEventListener('click', function() {
    if (audio.paused) {
      audio.play();
      audioIcon.className = 'fa fa-pause';
    } else {
      audio.pause();
      audioIcon.className = 'fa fa-play';
    }
  });

  audio.volume = 0.1; // Set the volume to 50%
});

document.querySelector('.home__title').addEventListener('click', function() {
  this.classList.toggle('active');
});
//////////////////////ANIMATION////////////////////////
gsap.registerPlugin(ScrollTrigger);

gsap.utils.toArray('.scrollable-card__item').forEach(function(item, index) {
  gsap.fromTo(item, 
    { opacity: 0, y: 50, scale: 0.9 }, // start state
    {
      opacity: 1,
      y: 0,
      scale: 1,
      duration: 1.5,
      ease: "power3.out",
      scrollTrigger: {
        trigger: item,
        start: 'top 80%',
        end: 'bottom 20%',
        scrub: true
      }
    }
  );

  gsap.fromTo(item, 
    { opacity: 0, scale: 0.8 }, // start state
    {
      opacity: 1,
      scale: 1,
      duration: 1,
      ease: "back.out(1.7)",
      stagger: {
        amount: 0.3,
        grid: "auto",
        from: "start",
      },
      scrollTrigger: {
        trigger: item,
        start: 'top 70%',
        end: 'bottom 30%',
        scrub: true
      }
    }
  );

  item.addEventListener("mouseenter", function() {
    gsap.to(item, { scale: 1.05, duration: 0.3, ease: "power1.out" });
  });

  item.addEventListener("mouseleave", function() {
    gsap.to(item, { scale: 1, duration: 0.3, ease: "power1.out" });
  });
});

/////////////////mouse effect////////////////////
options = {
  "outerStyle": "disable",
  "hoverEffect": "pointer-blur",
  "hoverItemMove": false,
  "defaultCursor": false,
  "outerWidth": 30,
  "outerHeight": 30
}
magicMouse(options);

/////////////////SCROLL TO TOP//////////////////////
// Get the button
var mybutton = document.getElementById("scrollToTopButton");
mybutton.style.opacity = 0; // Hide the button initially

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    gsap.to(mybutton, { opacity: 1, duration: 0.3 });
  } else {
    gsap.to(mybutton, { opacity: 0, duration: 0.3 });
  }
};

// When the user clicks on the button, scroll to the top of the document
mybutton.onclick = function() {
  window.scrollTo({top: 0, behavior: 'smooth'});
};

////////////////NAV SCOLL//////////////////////////
let lastScrollTop = 0;

window.addEventListener('scroll', function() {
    let currentScroll = window.pageYOffset || document.documentElement.scrollTop;
    if (currentScroll > lastScrollTop) {
        // Downscroll code
        document.getElementById('header').classList.add('nav-up');
    } else {
        // Upscroll code
        document.getElementById('header').classList.remove('nav-up');
    }
    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
}, false);


/////////////////START AT THE TOP//////////////////////
window.addEventListener('DOMContentLoaded', function() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
});

/////////////////canvas//////////////////////
// Define Particle class
class Particle {
  constructor(x, y, radius, color, velocity) {
    this.x = x;
    this.y = y;
    this.radius = radius;
    this.color = color;
    this.velocity = velocity;
  }

  draw(ctx) {
    // Get the color of the video pixel underneath the particle
    const pixelData = ctx.getImageData(this.x, this.y, 1, 1).data;

    // Invert the color
    const invertedColor = `rgb(${255 - pixelData[0]}, ${255 - pixelData[1]}, ${255 - pixelData[2]})`;

    // Draw the particle with the inverted color
    ctx.beginPath();
    ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false);
    ctx.fillStyle = invertedColor;
    ctx.fill();
    ctx.closePath();
  }

  update() {
    this.x += this.velocity.x;
    this.y += this.velocity.y;
  }
}

// Create a canvas element for particles
const canvas = document.createElement('canvas');
canvas.id = 'particle-canvas';
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;
canvas.style.position = 'fixed'; // Fix the position of the canvas
canvas.style.top = '0'; // Position canvas at the top left corner
canvas.style.left = '0';
canvas.style.pointerEvents = 'none'; // Disable pointer events on the canvas (so they don't interfere with the video)
document.body.appendChild(canvas);
const ctx = canvas.getContext('2d');

// Create an array to store the particles
const particles = [];

// Function to generate random number within a range
function randomRange(min, max) {
  return Math.random() * (max - min) + min;
}

// Function to initialize the particles
function initParticles() {
  for (let i = 0; i < 100; i++) {
    const x = randomRange(0, canvas.width);
    const y = randomRange(0, canvas.height);
    const radius = randomRange(1, 3);
    const color = '#fff'; // Change the color to '#fff' for normal colors
    const velocity = {
      x: randomRange(-1, 1),
      y: randomRange(-1, 1)
    };
    particles.push(new Particle(x, y, radius, color, velocity));
  }
}

// // Function to animate the particles
// function animateParticles() {
//   console.log('animateParticles is being called'); // Add this line
//   requestAnimationFrame(animateParticles);
//   ctx.clearRect(0, 0, canvas.width, canvas.height);

//   // Draw the video frame onto the canvas
//   ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

//   console.log('particles length:', particles.length); // Log the number of particles

//   // Draw particles with their original color
//   particles.forEach(particle => {
//     particle.update(); // Update particle position
//     particle.draw(ctx);
//   });

//   // Smoothly transition the canvas opacity
//   ctx.globalAlpha = 0.8;
// }

  // particles.forEach(particle => {
  //   // Get the color of the video pixel underneath the particle
  //   const pixelData = ctx.getImageData(particle.x - 1, particle.y - 1, 3, 3).data;

  //   // Invert the color
  //   const invertedColor = `rgb(${255 - pixelData[0]}, ${255 - pixelData[1]}, ${255 - pixelData[2]})`;

  //   // Set the color of the particle
  //   particle.color = invertedColor;

  //   // Draw the particle
  //   particle.draw(ctx);
  // });
  
// Function to replenish particles
function replenishParticles() {
  // Remove particles that are outside the canvas boundaries and create new ones
  for (let i = particles.length - 1; i >= 0; i--) {
    const particle = particles[i];
    if (
      particle.x < 0 ||
      particle.x > canvas.width ||
      particle.y < 0 ||
      particle.y > canvas.height
    ) {
      particles.splice(i, 1); // Remove the particle
      createParticle(); // Create a new particle
    }
  }
}

// Function to create a new particle
function createParticle() {
  const x = randomRange(0, canvas.width);
  const y = randomRange(0, canvas.height);
  const radius = randomRange(1, 3);
  const color = '#fff'; // Change the color to '#fff' for normal colors
  const velocity = {
    x: randomRange(-1, 1),
    y: randomRange(-1, 1)
  };
  particles.push(new Particle(x, y, radius, color, velocity));
}

// Function to animate the particles
function animateParticles() {
  requestAnimationFrame(animateParticles);
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  replenishParticles(); // Replenish particles as needed

  particles.forEach(particle => {
    particle.update();
  });
}


/////////////////video_canvas//////////////////////
// Create a video canvas element
const videoCanvas = document.createElement('canvas');
videoCanvas.id = 'video_canvas';
videoCanvas.width = window.innerWidth;
videoCanvas.height = window.innerHeight;
videoCanvas.style.position = 'fixed'; // Fix the position of the canvas
videoCanvas.style.top = '0'; // Position canvas at the top left corner
videoCanvas.style.left = '0';
document.body.appendChild(videoCanvas);

// Get the video canvas context
const videoCtx = videoCanvas.getContext('2d');

// Create a video element
const video = document.createElement('video');
video.autoplay = true;
video.loop = true;
video.muted = true; // Mute the video for autoplay
video.playsinline = true; // Add this line
video.src = 'assets/img/Untitled video - Made with Clipchamp.mp4'; // Replace 'path/to/video.mp4' with the actual path to your video file

// When the video is playing, draw its current frame to the video canvas
video.addEventListener('play', function() {
  const drawVideoFrame = () => {
    if (video.paused || video.ended) {
      return;
    }

    // Clear the video canvas
    videoCtx.clearRect(0, 0, videoCanvas.width, videoCanvas.height);
    
    // Draw the video frame onto the canvas
    videoCtx.drawImage(video, 0, 0, videoCanvas.width, videoCanvas.height);
    
    // Draw the particles on top of the video canvas
    for (let i = 0; i < particles.length; i++) {
      particles[i].draw(videoCtx);
    }
    
    // Request the next frame
    requestAnimationFrame(drawVideoFrame);
  };
  drawVideoFrame();
});

// Append the video element to the particle canvas
const particleCanvas = document.getElementById('particle-canvas');
particleCanvas.appendChild(video);

// Play the video even when it's not in the viewport
window.addEventListener('scroll', function() {
  const videoRect = video.getBoundingClientRect();
  const videoTop = videoRect.top;
  const videoBottom = videoRect.bottom;

  if (videoTop < window.innerHeight && videoBottom >= 0) {
    video.play().catch(error => {
      // Handle the error (e.g., video playback was prevented by the browser)
      console.error('Failed to start video playback:', error);
    });
  } else {
    video.pause();
  }
});

window.onload = function() {
  // Start video playback
  video.play();

  // // Initialize particles
  // initParticles();

  // // Animate particles
  // animateParticles();
};

// Function to handle mouse movement
function handleMouseMove(event) {
  // Calculate mouse position
  const mouseX = event.clientX;
  const mouseY = event.clientY;

  // Apply repulsion force to particles
  for (let i = 0; i < particles.length; i++) {
    const particle = particles[i];
    const dx = mouseX - particle.x;
    const dy = mouseY - particle.y;
    const distance = Math.sqrt(dx * dx + dy * dy);

    // Define maximum repulsion force and interaction radius
    const maxRepulsionForce = 10; // Adjust as needed
    const interactionRadius = 100; // Adjust as needed

    // Calculate repulsion force
    if (distance < interactionRadius) {
      const repulsionForce = maxRepulsionForce * (1 - distance / interactionRadius);
      particle.velocity.x -= dx * repulsionForce / distance;
      particle.velocity.y -= dy * repulsionForce / distance;
    }
  }
}

// Event listener for mouse movement
document.addEventListener('mousemove', handleMouseMove);


/////////////////CART MENU//////////////////////
const cartMenu = document.getElementById('cart-menu');
const cartIcon = document.getElementById('cart-icon');
const closeButton = document.getElementById('close-cart');

// Function to open the cart menu
function openCartMenu() {
  cartMenu.classList.add('show'); // Add the 'show' class to display the cart menu
}

// Function to close the cart menu
function closeCartMenu() {
  cartMenu.classList.remove('show'); // Remove the 'show' class to hide the cart menu
}

// Toggle cart menu when the cart icon is clicked
cartIcon.addEventListener('click', function(event) {
  event.preventDefault(); // Prevent default link behavior
  cartMenu.classList.toggle('show'); // Toggle the 'show' class on the cart menu
});

// Toggle cart menu when the cart icon is tapped on mobile
cartIcon.addEventListener('touchstart', function(event) {
  event.preventDefault(); // Prevent default touch behavior
  cartMenu.classList.toggle('show'); // Toggle the 'show' class on the cart menu
});



// Close cart menu when the close button is clicked
closeButton.addEventListener('click', closeCartMenu);

/////////////////adding items to CART//////////////////////
// Function to handle adding a product to the cart
function addToCart(productId) {
  // Fetch the product details from the server
  fetch(`get_product_details.php?id=${productId}`)
    .then(response => {
      if (!response.ok) {
        throw new Error('Error fetching product details: ' + response.status);
      }
      return response.json();
    })
    .then(product => {
      // Retrieve the cart from localStorage
      const cart = JSON.parse(localStorage.getItem('cart')) || [];

      // Check if the product is already in the cart
      const existingProduct = cart.find(item => item.id === productId);

      if (existingProduct) {
        // If the product is already in the cart, increment its quantity
        existingProduct.quantity++;
      } else {
        // If the product is not in the cart, add it with a quantity of 1
        product.id = productId;
        product.quantity = 1;
        cart.push(product);
      }

      // Save the updated cart back to localStorage
      localStorage.setItem('cart', JSON.stringify(cart));

      // Update the cart items section to display the added product
      updateCartItems();
    })
    .catch(error => {
      console.error('Error fetching product details:', error.message);
    });
}

// Function to update the cart items section
function updateCartItems() {
    const cartItemsContainer = document.getElementById('cart-items');
    // Clear the existing cart items
    cartItemsContainer.innerHTML = '';

    // Retrieve the products from the cart (assuming stored in localStorage)
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    // Iterate through each product in the cart and display it
    cart.forEach(product => {
        const cartItem = document.createElement('div');
        cartItem.classList.add('cart-item');
        cartItem.innerHTML = `
            <img src="${product.image_url || product.front_image_url || 'path/to/default/image.jpg'}" alt="Product Image" class="cart-item__img">
            <div class="cart-item__content">
          <h3 class="cart-item__title">${product.name}</h3>
          <h5 class="cart-item__price">$${product.price}</h5>
          
          <button class="cart-item__remove-button magic-hover magic-hover__square" onclick="removeFromCart(${product.id})"><i class="ri-delete-bin-line"></i></button>
            </div>
        `;
        cartItemsContainer.appendChild(cartItem);
    });
}

function removeFromCart(productId) {
  // Retrieve the cart from localStorage
  let cart = JSON.parse(localStorage.getItem('cart')) || [];

  // Find the index of the product with the given ID
  const productIndex = cart.findIndex(product => product.id === productId);

  // If the product is found, decrement its quantity
  if (productIndex !== -1) {
    // Decrement the quantity
    cart[productIndex].quantity--;

    // If quantity becomes zero, remove the product from the cart
    if (cart[productIndex].quantity === 0) {
      cart.splice(productIndex, 1);
    }
  }

  // If you want to delete a property (e.g., 'price') from each product object
  cart = cart.map(product => {
    delete product.id; // replace 'price' with the property you want to delete
    return product;
  });

  // Save the updated cart back to localStorage
  localStorage.setItem('cart', JSON.stringify(cart));

  // Update the cart items on the page
  updateCartItems();
}



// Attach an event listener to each "Add to cart" button, so we can react when one of them is clicked
document.querySelectorAll('.cart__button').forEach(button => {
    button.addEventListener('click', function(event) {
        // Extract the product ID from the button's ID attribute
        const productId = event.target.getAttribute('data-product-id');
        // Add the product to the cart
        addToCart(productId);
    });
});

// Call the function to initially update the cart items section when the page loads
updateCartItems();

/////////////////CART MENU//////////////////////
// Function to update the cart items section and calculate the total price
function updateCartItems() {
  const cartItemsContainer = document.getElementById('cart-items');
  const cartTotalElement = document.getElementById('cart-total');
  
  // Clear the existing cart items
  cartItemsContainer.innerHTML = '';

  // Retrieve the products from the cart (assuming stored in localStorage)
  const cart = JSON.parse(localStorage.getItem('cart')) || [];
  let totalPrice = 0;

  // Iterate through each product in the cart and display it
  cart.forEach(product => {
      const cartItem = document.createElement('div');
      cartItem.classList.add('cart-item');
      cartItem.innerHTML = `
          <img src="${product.image_url || product.front_image_url || 'path/to/default/image.jpg'}" alt="Product Image" class="cart-item__img">
          <div class="cart-item__content">
              <h3 class="cart-item__title">${product.name}</h3>
              <h5 class="cart-item__price">$${parseFloat(product.price).toFixed(2)}</h5> <!-- Display individual price without multiplication -->
              <h5 class="cart-item__quantity">Quantity: ${product.quantity}</h5>
              
              <button class="cart-item__remove-button magic-hover magic-hover__square" onclick="removeFromCart(${product.id})"><i class="ri-delete-bin-line"></i></button>
          </div>
      `;
      cartItemsContainer.appendChild(cartItem);

      // Add the price of the current product multiplied by its quantity to the total price
      totalPrice += parseFloat(product.price) * parseInt(product.quantity);
  });

  // Update the cart total
  cartTotalElement.textContent = totalPrice.toFixed(2); // Display total with 2 decimal places
}
