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

  
  ///////////////mouse/////////////////////
  options = {
    "outerStyle": "disable",
    "hoverEffect": "pointer-blur",
    "hoverItemMove": false,
    "defaultCursor": false,
    "outerWidth": 30,
    "outerHeight": 30
  }
  magicMouse(options);

  //////////////ceck cost total//////////////