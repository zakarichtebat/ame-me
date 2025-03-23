<template>
  <section class="slider-section">
    <div class="slider-container">
      <h2 class="section-title" :class="{ 'visible': titleVisible }" ref="sectionTitle">
        "Transforming Ideas into Reality: Concept Design & Planning Services"
      </h2>

      <!-- Navigation buttons -->
      <div class="slider-controls">
        <button 
          class="slider-arrow prev" 
          :class="{ 'disabled': currentSlide === 0 }"
          @click="prevSlide"
          aria-label="Previous slide"
        >
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 18l-6-6 6-6"/>
          </svg>
        </button>
        
        <div class="slider-dots">
          <button 
            v-for="n in 3" 
            :key="n"
            class="slider-dot"
            :class="{ 'active': currentSlide === n - 1 }"
            @click="goToSlide(n - 1)"
            :aria-label="`Go to slide ${n}`"
          ></button>
        </div>
        
        <button 
          class="slider-arrow next"
          :class="{ 'disabled': currentSlide === 2 }"
          @click="nextSlide"
          aria-label="Next slide"
        >
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 18l6-6-6-6"/>
          </svg>
        </button>
      </div>

      <!-- Slider track -->
      <div class="slider-track" :style="{ transform: `translateX(${-currentSlide * 100}%)` }">
        <!-- Slide 1: Conceptual Design -->
        <div class="slide">
          <div class="slide-content" :class="{ 'active': currentSlide === 0 }">
            <div class="slide-image-container">
              <div class="slide-image-grid">
                <div class="grid-item" :style="{ '--delay': '0.1s' }">
                  <img :src="excellenceImage" alt="Conceptual Design" />
                </div>
              </div>
              <div class="slide-overlay"></div>
            </div>
            <div class="slide-text">
              <h3 class="slide-title">Conceptual Design</h3>
              <p class="slide-description">
                Our commitment to excellence drives us to go beyond standard solutions, delivering superior engineering and maintenance services that stand the test of time. We continuously innovate and refine our processes to ensure the highest quality in every project.
              </p>
              
              <div class="slide-features">
                <div class="feature-item" v-for="(feature, index) in conceptualFeatures" :key="index" :style="{ '--delay': `${0.2 + (index * 0.1)}s` }">
                  <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18">
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                  </div>
                  <span>{{ feature }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Slide 2: Project Planning -->
        <div class="slide">
          <div class="slide-content" :class="{ 'active': currentSlide === 1 }">
            <div class="slide-image-container">
              <div class="slide-image-grid">
                <div class="grid-item" :style="{ '--delay': '0.1s' }">
                  <img :src="professionalismImage" alt="Project Planning" />
                </div>
              </div>
              <div class="slide-overlay"></div>
            </div>
            <div class="slide-text">
              <h3 class="slide-title">Project Planning</h3>
              <p class="slide-description">
                Professionalism is the foundation of our approach. From transparent communication to timely project delivery, we uphold the highest standards, ensuring reliability and integrity in every interaction and service we provide.
              </p>
              
              <div class="slide-features">
                <div class="feature-item" v-for="(feature, index) in planningFeatures" :key="index" :style="{ '--delay': `${0.2 + (index * 0.1)}s` }">
                  <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18">
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                  </div>
                  <span>{{ feature }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Slide 3: Detailed Engineering Design -->
        <div class="slide">
          <div class="slide-content" :class="{ 'active': currentSlide === 2 }">
            <div class="slide-image-container">
              <div class="slide-image-grid">
                <div class="grid-item" :style="{ '--delay': '0.1s' }">
                  <img :src="expertiseImage" alt="Detailed Engineering Design" />
                </div>
              </div>
              <div class="slide-overlay"></div>
            </div>
            <div class="slide-text">
              <h3 class="slide-title">Detailed Engineering Design</h3>
              <p class="slide-description">
                With years of experience and specialized knowledge, our team brings expertise that you can trust. We combine technical skill with industry insights, providing solutions tailored to your needs and ensuring precision in every detail.
              </p>
              
              <div class="slide-features">
                <div class="feature-item" v-for="(feature, index) in engineeringFeatures" :key="index" :style="{ '--delay': `${0.2 + (index * 0.1)}s` }">
                  <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18">
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                  </div>
                  <span>{{ feature }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import excellenceImage from '../components/image/expertise-edited.png';
import professionalismImage from '../components/image/proffessionalism-edited.png';
import expertiseImage from '../components/image/expertiseee-edited.png';

export default {
  name: 'AnimatedSliderComponent',
  data() {
    return {
      currentSlide: 0,
      titleVisible: false,
      autoplayInterval: null,
      excellenceImage,
      professionalismImage,
      expertiseImage,
      conceptualFeatures: [
        'Creative Ideation: Generating innovative solutions tailored to client needs',
        'Feasibility Analysis: Evaluating the technical and financial viability of each concept',
        'Visualization and Prototyping: Creating models and mockups for a clear vision of the final product',
        'Project requirements analysis',
        'Concept validation'
      ],
      planningFeatures: [
        'Strategic Roadmapping: Defining key milestones and phases for efficient project execution',
        'Resource Allocation: Efficient management of resources, budgets, and timelines',
        'Risk Management: Identifying potential risks early and preparing mitigation strategies',
        'Stakeholder collaboration',
        'Quality assurance planning'
      ],
      engineeringFeatures: [
        'Precision Modeling: Developing detailed CAD models with technical specifications',
        'Compliance and Standards: Ensuring all designs meet industry regulations and safety standards',
        'Integration Readiness: Preparing designs that seamlessly integrate with existing systems',
        'Design optimization',
        'Implementation documentation'
      ]
    };
  },
  mounted() {
    // Set up intersection observer for title animation
    this.setupTitleObserver();
    
    // Start autoplay
    this.startAutoplay();
    
    // Clean up on page navigation
    window.addEventListener('beforeunload', this.cleanup);
  },
  beforeDestroy() {
    this.cleanup();
  },
  methods: {
    prevSlide() {
      if (this.currentSlide > 0) {
        this.currentSlide--;
        this.resetAutoplay();
      }
    },
    nextSlide() {
      if (this.currentSlide < 2) {
        this.currentSlide++;
        this.resetAutoplay();
      }
    },
    goToSlide(index) {
      this.currentSlide = index;
      this.resetAutoplay();
    },
    startAutoplay() {
      this.stopAutoplay();
      this.autoplayInterval = setInterval(() => {
        if (this.currentSlide < 2) {
          this.currentSlide++;
        } else {
          this.currentSlide = 0;
        }
      }, 6000);
    },
    stopAutoplay() {
      if (this.autoplayInterval) {
        clearInterval(this.autoplayInterval);
      }
    },
    resetAutoplay() {
      this.stopAutoplay();
      this.startAutoplay();
    },
    setupTitleObserver() {
      const options = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
      };
      
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            this.titleVisible = true;
            observer.unobserve(entry.target);
          }
        });
      }, options);
      
      if (this.$refs.sectionTitle) {
        observer.observe(this.$refs.sectionTitle);
      }
    },
    cleanup() {
      // Remove event listeners
      window.removeEventListener('beforeunload', this.cleanup);
      
      // Stop autoplay
      this.stopAutoplay();
    }
  }
};
</script>

<style scoped>
.slider-section {
  padding: 5rem 0;
  background-color: #0c1222;
  color: #f8fafc;
  position: relative;
  overflow: hidden;
}

.slider-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: radial-gradient(circle at top right, rgba(59, 130, 246, 0.08), transparent 70%);
  z-index: 0;
}

.slider-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 2rem;
  position: relative;
  z-index: 1;
}

.section-title {
  text-align: center;
  font-size: 2.2rem;
  font-weight: 700;
  margin-bottom: 3.5rem;
  color: #f8fafc;
  opacity: 0;
  transform: translateY(30px);
  transition: opacity 1s ease, transform 1s ease;
  position: relative;
}

.section-title::after {
  content: '';
  position: absolute;
  bottom: -15px;
  left: 50%;
  transform: translateX(-50%);
  width: 60px;
  height: 3px;
  background: linear-gradient(90deg, #3b82f6, #10b981);
  transition: width 1s ease 0.3s;
  width: 0;
}

.section-title.visible {
  opacity: 1;
  transform: translateY(0);
}

.section-title.visible::after {
  width: 100px;
}

/* Slider controls */
.slider-controls {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 2rem;
}

.slider-arrow {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background-color: rgba(59, 130, 246, 0.1);
  border: 1px solid rgba(59, 130, 246, 0.2);
  color: #3b82f6;
  cursor: pointer;
  transition: all 0.3s ease;
}

.slider-arrow:hover {
  background-color: rgba(59, 130, 246, 0.2);
  transform: scale(1.05);
}

.slider-arrow.disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.slider-dots {
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 0 1.5rem;
}

.slider-dot {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  background-color: rgba(203, 213, 225, 0.3);
  margin: 0 0.5rem;
  cursor: pointer;
  transition: all 0.3s ease;
  border: none;
}

.slider-dot.active {
  background-color: #3b82f6;
  transform: scale(1.2);
}

/* Slider track */
.slider-track {
  display: flex;
  transition: transform 0.8s ease;
  width: 100%;
}

.slide {
  min-width: 100%;
  padding: 0 1rem;
}

.slide-content {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 3rem;
  opacity: 0.5;
  transform: scale(0.95);
  transition: opacity 0.8s ease, transform 0.8s ease;
}

.slide-content.active {
  opacity: 1;
  transform: scale(1);
}

.slide-image-container {
  position: relative;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
  transform: perspective(1000px) rotateY(0deg);
  transition: transform 0.7s ease;
}

.slide-content:hover .slide-image-container {
  transform: perspective(1000px) rotateY(3deg);
}

.slide-image-grid {
  display: grid;
  grid-template-columns: 1fr;
  grid-template-rows: 1fr;
  height: 100%;
}

.grid-item {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.8s ease var(--delay), transform 0.8s ease var(--delay);
  overflow: hidden;
}

.slide-content.active .grid-item {
  opacity: 1;
  transform: translateY(0);
}

.grid-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 1.6s ease;
  transform: scale(1.05) translateX(0);
}

.slide-content.active .grid-item img {
  transform: scale(1.1);
}

.slide-content:hover .grid-item img {
  transform: scale(1.15) translateX(-10px);
}

.slide-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(to right, rgba(12, 18, 34, 0.4), rgba(12, 18, 34, 0.1));
  pointer-events: none;
}

.slide-text {
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.slide-title {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 1.5rem;
  color: #f8fafc;
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.6s ease, transform 0.6s ease;
}

.slide-content.active .slide-title {
  opacity: 1;
  transform: translateY(0);
}

.slide-description {
  font-size: 1.1rem;
  line-height: 1.7;
  color: #cbd5e1;
  margin-bottom: 2rem;
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.6s ease 0.1s, transform 0.6s ease 0.1s;
}

.slide-content.active .slide-description {
  opacity: 1;
  transform: translateY(0);
}

.slide-features {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.feature-item {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  font-size: 1rem;
  color: #e2e8f0;
  opacity: 0;
  transform: translateX(20px);
  transition: opacity 0.5s ease var(--delay), transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) var(--delay);
  padding: 0.5rem 0.75rem;
  border-radius: 6px;
}

.slide-content.active .feature-item {
  opacity: 1;
  transform: translateX(0);
}

.slide-content.active .feature-item:hover {
  background-color: rgba(59, 130, 246, 0.1);
  transform: translateX(5px);
}

.feature-icon {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 28px;
  height: 28px;
  border-radius: 50%;
  background-color: rgba(59, 130, 246, 0.2);
  color: #3b82f6;
  transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.feature-item:hover .feature-icon {
  transform: scale(1.2) rotate(10deg);
  background-color: rgba(59, 130, 246, 0.3);
}

/* Responsive Styles */
@media (max-width: 1024px) {
  .slide-content {
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
  }
  
  .slide-title {
    font-size: 2rem;
  }
}

@media (max-width: 768px) {
  .slide-content {
    grid-template-columns: 1fr;
    gap: 2rem;
  }
  
  .slide-image-container {
    aspect-ratio: 16 / 9;
  }
  
  .section-title {
    font-size: 1.8rem;
  }
  
  .slide-title {
    font-size: 1.8rem;
    margin-top: 1.5rem;
  }
}

@media (max-width: 640px) {
  .slider-controls {
    margin-bottom: 1.5rem;
  }
  
  .section-title {
    font-size: 1.6rem;
    margin-bottom: 2.5rem;
  }
  
  .slide-title {
    font-size: 1.6rem;
  }
  
  .slide-description {
    font-size: 1rem;
  }
}
</style> 