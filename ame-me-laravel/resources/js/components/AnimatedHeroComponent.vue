<template>
  <section class="hero-section">
    <div class="hero-background">
      <div class="overlay"></div>
    </div>
    
    <div class="hero-content">
      <div class="hero-text" :class="{ 'visible': isVisible }">
        <h1 class="hero-title">
          <span class="title-line">Building, Maintaining, and Enhancing</span>
          <span class="title-line highlight">Your Machinery</span>
        </h1>
        
        <div class="hero-subtitle">
          <div class="subtitle-line">
            <div class="subtitle-bar"></div>
            <p>Empowering Your Operations with Precision and Care</p>
          </div>
        </div>
        
        <div class="hero-cta">
          <a href="/about" class="about-btn">About us</a>
        </div>
      </div>
    </div>
    
    <div class="gear gear-large"></div>
    <div class="gear gear-medium"></div>
    <div class="gear gear-small"></div>
  </section>
</template>

<script>
export default {
  name: 'AnimatedHeroComponent',
  data() {
    return {
      isVisible: false
    };
  },
  mounted() {
    // Show hero content with animation after the component is mounted
    setTimeout(() => {
      this.isVisible = true;
    }, 300);
  }
};
</script>

<style scoped>
.hero-section {
  position: relative;
  width: 100vw;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  overflow: hidden;
  margin-left: calc(-50vw + 50%);
  margin-right: calc(-50vw + 50%);
}

.hero-background {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url(image/cnc-fraesen-maschinenbau-palm-scaled-1.jpg);
  background-size: cover;
  background-position: center;
  z-index: -1;
  animation: zoomIn 20s ease-in-out infinite alternate;
}

@keyframes zoomIn {
  from {
    transform: scale(1);
  }
  to {
    transform: scale(1.1);
  }
}

.overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(rgba(22, 41, 75, 0.75), rgba(39, 62, 102, 0.85));
}

.hero-content {
  max-width: 1200px;
  width: 100%;
  margin: 0 auto;
  padding: 4rem 2rem;
  color: white;
  z-index: 1;
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.hero-text {
  margin-bottom: 3rem;
  opacity: 0;
  transform: translateY(30px);
  transition: opacity 1s ease, transform 1s ease;
}

.hero-text.visible {
  opacity: 1;
  transform: translateY(0);
}

.hero-title {
  font-size: 3.5rem;
  font-weight: 700;
  line-height: 1.2;
  margin-bottom: 1.5rem;
  text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.title-line {
  display: block;
}

.title-line.highlight {
  color: #3b82f6;
  position: relative;
  display: inline-block;
}

.title-line.highlight::after {
  content: '';
  position: absolute;
  bottom: -5px;
  left: 0;
  width: 0;
  height: 3px;
  background: linear-gradient(90deg, #3b82f6, transparent);
  animation: expandWidth 1.5s ease-out 1s forwards;
}

@keyframes expandWidth {
  to {
    width: 100%;
  }
}

.hero-subtitle {
  margin-bottom: 2rem;
}

.subtitle-line {
  display: flex;
  align-items: center;
  margin-bottom: 0.5rem;
}

.subtitle-bar {
  width: 4px;
  height: 25px;
  background-color: #3b82f6;
  margin-right: 1rem;
  animation: pulseBar 3s ease-in-out infinite;
}

@keyframes pulseBar {
  0%, 100% {
    opacity: 1;
    transform: scaleY(1);
  }
  50% {
    opacity: 0.8;
    transform: scaleY(1.2);
  }
}

.hero-cta {
  margin-top: 2.5rem;
}

.about-btn {
  display: inline-block;
  padding: 0.75rem 2.5rem;
  background-color: rgba(59, 130, 246, 0.2);
  color: white;
  border: 2px solid #3b82f6;
  border-radius: 4px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
  box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
  animation: pulseCTA 2s ease-in-out infinite;
}

@keyframes pulseCTA {
  0% {
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
  }
  50% {
    box-shadow: 0 4px 20px rgba(59, 130, 246, 0.7);
  }
  100% {
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
  }
}

.about-btn:hover {
  background-color: #3b82f6;
  transform: translateY(-3px);
  box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
}

.about-btn::after {
  content: '';
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: -100%;
  background: linear-gradient(
    90deg,
    transparent,
    rgba(255, 255, 255, 0.2),
    transparent
  );
  transition: 0.6s;
}

.about-btn:hover::after {
  left: 100%;
}

/* Decorative gears */
.gear {
  position: absolute;
  border-radius: 50%;
  border: 4px solid rgba(59, 130, 246, 0.2);
  z-index: 0;
  box-shadow: 0 0 30px rgba(59, 130, 246, 0.3);
}

.gear::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 20%;
  height: 20%;
  background-color: rgba(59, 130, 246, 0.2);
  border-radius: 50%;
  transform: translate(-50%, -50%);
}

.gear-large {
  width: 300px;
  height: 300px;
  top: -100px;
  right: -100px;
  animation: rotateGear 30s linear infinite;
}

.gear-medium {
  width: 150px;
  height: 150px;
  bottom: 50px;
  right: 50px;
  animation: rotateGear 20s linear infinite reverse;
}

.gear-small {
  width: 100px;
  height: 100px;
  bottom: 20%;
  left: 50px;
  animation: rotateGear 15s linear infinite;
}

@keyframes rotateGear {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}

/* Responsive styles */
@media (max-width: 992px) {
  .hero-title {
    font-size: 2.5rem;
  }
}

@media (max-width: 768px) {
  .hero-section {
    min-height: 100vh;
  }
  
  .hero-title {
    font-size: 2rem;
  }
  
  .gear-large {
    width: 200px;
    height: 200px;
  }
  
  .gear-medium, .gear-small {
    display: none;
  }
}

@media (max-width: 480px) {
  .hero-content {
    padding: 3rem 1.5rem;
  }
  
  .hero-title {
    font-size: 1.75rem;
  }
  
  .hero-subtitle {
    font-size: 0.9rem;
  }
}
</style> 