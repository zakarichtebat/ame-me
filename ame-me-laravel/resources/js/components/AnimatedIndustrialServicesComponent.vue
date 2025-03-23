<template>
  <section class="industrial-section">
    <div class="container">
      <h2 class="section-title" :class="{ 'visible': titleVisible }" ref="sectionTitle">
        „Precision Solutions in Steel Construction, Piping, and Mechanical Devices"
      </h2>
      
      <div class="services-grid">
        <!-- Steel Construction -->
        <div 
          class="service-card" 
          :class="{ 'visible': isVisible }"
          @click="activeService = activeService === 'steel' ? null : 'steel'"
        >
          <div class="service-image">
            <img :src="steelImage" alt="Steel Construction" />
            <div class="image-overlay"></div>
          </div>
          <h3 class="service-title">Steel Construction</h3>
          <transition name="expand">
            <div v-if="activeService === 'steel'" class="service-details">
              <ul class="service-features">
                <li v-for="(feature, index) in steelFeatures" :key="index" 
                    :style="{ '--delay': `${0.1 + (index * 0.05)}s` }">
                  <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                  </div>
                  <span v-html="feature"></span>
                </li>
              </ul>
            </div>
          </transition>
        </div>
        
        <!-- Piping -->
        <div 
          class="service-card" 
          :class="{ 'visible': isVisible }"
          @click="activeService = activeService === 'piping' ? null : 'piping'"
        >
          <div class="service-image">
            <img :src="pipingImage" alt="Piping" />
            <div class="image-overlay"></div>
          </div>
          <h3 class="service-title">Piping</h3>
          <transition name="expand">
            <div v-if="activeService === 'piping'" class="service-details">
              <ul class="service-features">
                <li v-for="(feature, index) in pipingFeatures" :key="index" 
                    :style="{ '--delay': `${0.1 + (index * 0.05)}s` }">
                  <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                  </div>
                  <span v-html="feature"></span>
                </li>
              </ul>
            </div>
          </transition>
        </div>
        
        <!-- Mechanical Devices -->
        <div 
          class="service-card" 
          :class="{ 'visible': isVisible }"
          @click="activeService = activeService === 'mechanical' ? null : 'mechanical'"
        >
          <div class="service-image">
            <img :src="mechanicalImage" alt="Mechanical Devices" />
            <div class="image-overlay"></div>
          </div>
          <h3 class="service-title">Mechanical Devices</h3>
          <transition name="expand">
            <div v-if="activeService === 'mechanical'" class="service-details">
              <ul class="service-features">
                <li v-for="(feature, index) in mechanicalFeatures" :key="index" 
                    :style="{ '--delay': `${0.1 + (index * 0.05)}s` }">
                  <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                  </div>
                  <span v-html="feature"></span>
                </li>
              </ul>
            </div>
          </transition>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import steelImage from '../components/image/expertise-edited.png';
import pipingImage from '../components/image/proffessionalism-edited.png';
import mechanicalImage from '../components/image/expertiseee-edited.png';

export default {
  name: 'AnimatedIndustrialServicesComponent',
  data() {
    return {
      isVisible: false,
      titleVisible: false,
      activeService: null,
      steelImage,
      pipingImage,
      mechanicalImage,
      steelFeatures: [
        '<strong>Custom Structural Design:</strong> Tailored steel frameworks and structures designed for strength and durability.',
        '<strong>Fabrication and Assembly:</strong> High-quality steel fabrication with precise assembly for various industrial needs.',
        '<strong>On-Site Installation and Support:</strong> Full-service installation and post-installation support to ensure lasting performance.'
      ],
      pipingFeatures: [
        '<strong>Pipe System Design and Planning:</strong> Comprehensive layout and planning for efficient and safe piping systems.',
        '<strong>Installation and Maintenance:</strong> Professional installation and regular maintenance of piping systems to ensure optimal flow and safety.',
        '<strong>Leak Detection and Repair:</strong> Advanced leak detection services with rapid repairs to minimize downtime and prevent hazards.'
      ],
      mechanicalFeatures: [
        '<strong>Custom Machinery Design:</strong> Engineering and design of specialized mechanical devices to meet unique operational needs.',
        '<strong>Installation and Calibration:</strong> Expert installation with precise calibration for smooth and accurate operation.',
        '<strong>Repair and Upgrades:</strong> Maintenance, repairs, and upgrades to extend the life and performance of machinery.'
      ]
    };
  },
  mounted() {
    this.setupObserver();
  },
  methods: {
    setupObserver() {
      const options = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
      };
      
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            if (entry.target === this.$refs.sectionTitle) {
              this.titleVisible = true;
            } else {
              this.isVisible = true;
            }
            observer.unobserve(entry.target);
          }
        });
      }, options);
      
      if (this.$refs.sectionTitle) {
        observer.observe(this.$refs.sectionTitle);
      }
      
      // Observer for the section as a whole
      observer.observe(this.$el);
    }
  }
};
</script>

<style scoped>
.industrial-section {
  padding: 6rem 0;
  background-color: #111827;
  color: #f8fafc;
  position: relative;
  overflow: hidden;
}

.industrial-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: radial-gradient(circle at bottom left, rgba(79, 70, 229, 0.1), transparent 70%);
  z-index: 0;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 1.5rem;
  position: relative;
  z-index: 1;
}

.section-title {
  text-align: center;
  font-size: 2.2rem;
  font-weight: 700;
  margin-bottom: 4rem;
  color: #f8fafc;
  opacity: 0;
  transform: translateY(30px);
  transition: opacity 1s ease, transform 1s ease;
  position: relative;
}

.section-title::after {
  content: '';
  position: absolute;
  bottom: -20px;
  left: 50%;
  transform: translateX(-50%);
  width: 0;
  height: 3px;
  background: linear-gradient(90deg, #4f46e5, #10b981);
  transition: width 1s ease 0.5s;
}

.section-title.visible {
  opacity: 1;
  transform: translateY(0);
}

.section-title.visible::after {
  width: 120px;
}

.services-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 2rem;
  margin-top: 2rem;
}

.service-card {
  background-color: rgba(17, 24, 39, 0.8);
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
  transition: all 0.5s ease;
  transform: translateY(40px);
  opacity: 0;
  cursor: pointer;
  border: 1px solid rgba(55, 65, 81, 0.3);
}

.service-card.visible {
  transform: translateY(0);
  opacity: 1;
}

.service-card:nth-child(1) {
  transition-delay: 0.1s;
}

.service-card:nth-child(2) {
  transition-delay: 0.3s;
}

.service-card:nth-child(3) {
  transition-delay: 0.5s;
}

.service-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
  border-color: rgba(79, 70, 229, 0.4);
}

.service-image {
  position: relative;
  height: 200px;
  overflow: hidden;
}

.service-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.7s ease;
}

.service-card:hover .service-image img {
  transform: scale(1.1);
}

.image-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(to bottom, rgba(17, 24, 39, 0), rgba(17, 24, 39, 0.8));
}

.service-title {
  padding: 1.5rem;
  font-size: 1.8rem;
  font-weight: 600;
  text-align: center;
  margin: 0;
  color: #f8fafc;
  border-bottom: 2px solid transparent;
  transition: all 0.3s ease;
}

.service-card:hover .service-title {
  color: #6366f1;
  border-bottom-color: rgba(79, 70, 229, 0.4);
}

.service-details {
  padding: 0 1.5rem 1.5rem;
}

.service-features {
  list-style: none;
  padding: 0;
  margin: 0;
}

.service-features li {
  display: flex;
  align-items: flex-start;
  margin-bottom: 1rem;
  padding: 0.5rem;
  border-radius: 6px;
  background-color: rgba(55, 65, 81, 0.2);
  transform: translateX(-20px);
  opacity: 0;
  animation: slideIn 0.5s forwards;
  animation-delay: var(--delay);
}

@keyframes slideIn {
  to {
    transform: translateX(0);
    opacity: 1;
  }
}

.feature-icon {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-shrink: 0;
  width: 24px;
  height: 24px;
  border-radius: 50%;
  background-color: rgba(79, 70, 229, 0.2);
  color: #6366f1;
  margin-right: 12px;
  margin-top: 3px;
}

.service-features li span {
  color: #d1d5db;
  font-size: 0.95rem;
  line-height: 1.5;
}

.service-features li span strong {
  color: #e5e7eb;
}

/* Transition for expanding details */
.expand-enter-active, 
.expand-leave-active {
  transition: all 0.3s ease;
  max-height: 300px;
  overflow: hidden;
  opacity: 1;
}

.expand-enter-from, 
.expand-leave-to {
  max-height: 0;
  opacity: 0;
  overflow: hidden;
}

/* Responsive styles */
@media (max-width: 1024px) {
  .services-grid {
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
  }
  
  .service-title {
    font-size: 1.5rem;
  }
}

@media (max-width: 768px) {
  .services-grid {
    grid-template-columns: repeat(2, 1fr);
  }
  
  .section-title {
    font-size: 1.8rem;
  }
}

@media (max-width: 640px) {
  .services-grid {
    grid-template-columns: 1fr;
  }
  
  .section-title {
    font-size: 1.6rem;
  }
}
</style> 