<template>
  <section class="maintenance-section">
    <div class="container">
      <h2 class="section-title" :class="{ 'visible': titleVisible }" ref="sectionTitle">
        „Expert Maintenance Services for Optimal Machine Efficiency and Longevity"
      </h2>
      
      <div class="services-container">
        <div 
          v-for="(service, index) in services" 
          :key="index"
          class="service-row"
          :class="{ 'active': activeService === index }"
        >
          <div class="service-image-panel">
            <img :src="service.image" :alt="service.title" class="service-image" />
          </div>
          
          <div class="service-title-panel">
            <h3 class="service-title">{{ service.title }}</h3>
          </div>
          
          <div class="service-details-panel">
            <div class="service-items">
              <div 
                v-for="(item, i) in service.items" 
                :key="i"
                class="service-item"
                :style="{ '--item-delay': `${i * 0.1 + 0.3}s` }"
              >
                <div class="item-header">
                  <div class="item-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                      <path fill="none" stroke="#3b82f6" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                  </div>
                  <span class="item-title">{{ item.title }}</span>
                </div>
                <p class="item-description">{{ item.description }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="navigation-controls">
        <button 
          v-for="(service, index) in services" 
          :key="index"
          class="nav-dot"
          :class="{ 'active': activeService === index }"
          @click="setActiveService(index)"
        ></button>
      </div>
    </div>
  </section>
</template>

<script>
import foundryImage from '../components/image/expertise-edited.png';
import weldingImage from '../components/image/proffessionalism-edited.png';
import diagnosticImage from '../components/image/expertiseee-edited.png';

export default {
  name: 'AnimatedMaintenanceComponent',
  data() {
    return {
      activeService: 0,
      titleVisible: false,
      services: [
        {
          title: 'Foundry',
          image: foundryImage,
          items: [
            { 
              title: 'Regular Inspection & Upkeep', 
              description: 'Ensuring all foundry equipment operates smoothly with minimal downtime.' 
            },
            { 
              title: 'Heat-Resistant Repairs', 
              description: 'Specialized repairs using heat-resistant materials for high-performance durability.' 
            },
            { 
              title: 'Safety & Compliance', 
              description: 'Maintaining strict safety standards to protect workers and meet industry regulations.' 
            }
          ]
        },
        {
          title: 'Welding',
          image: weldingImage,
          items: [
            { 
              title: 'Precision Welding Repairs', 
              description: 'Expert welders restore equipment to optimal condition using precision techniques.' 
            },
            { 
              title: 'Corrosion Protection', 
              description: 'Applying protective coatings to prevent corrosion and extend equipment life.' 
            },
            { 
              title: 'Quality Assurance', 
              description: 'Regular quality checks to ensure welding integrity and high performance under demanding conditions.' 
            }
          ]
        },
        {
          title: 'Diagnostic',
          image: diagnosticImage,
          items: [
            { 
              title: 'Detailed Reporting', 
              description: 'Providing comprehensive diagnostic reports for clear, actionable insights into equipment health.' 
            },
            { 
              title: 'Advanced Equipment Analysis', 
              description: 'Using state-of-the-art diagnostic tools to identify potential issues early.' 
            },
            { 
              title: 'Predictive Maintenance', 
              description: 'Implementing predictive maintenance to prevent unexpected breakdowns.' 
            }
          ]
        }
      ]
    };
  },
  mounted() {
    this.setupTitleObserver();
    this.startAutoRotation();
  },
  beforeUnmount() {
    this.stopAutoRotation();
  },
  methods: {
    setActiveService(index) {
      this.activeService = index;
      this.resetAutoRotation();
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
    startAutoRotation() {
      this.rotationInterval = setInterval(() => {
        this.activeService = (this.activeService + 1) % this.services.length;
      }, 7000);
    },
    stopAutoRotation() {
      if (this.rotationInterval) {
        clearInterval(this.rotationInterval);
      }
    },
    resetAutoRotation() {
      this.stopAutoRotation();
      this.startAutoRotation();
    }
  }
};
</script>

<style scoped>
.maintenance-section {
  padding: 6rem 0;
  background-color: #111927;
  color: #f8fafc;
  position: relative;
  overflow: hidden;
}

.maintenance-section::before {
  content: '';
  position: absolute;
  top: 0;
  right: 0;
  width: 100%;
  height: 100%;
  background: radial-gradient(circle at top right, rgba(59, 130, 246, 0.05), transparent 70%);
  z-index: 0;
}

.container {
  max-width: 1400px;
  margin: 0 auto;
  padding: 0 2rem;
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
  bottom: -15px;
  left: 50%;
  transform: translateX(-50%);
  width: 0;
  height: 3px;
  background: linear-gradient(90deg, #3b82f6, #10b981);
  transition: width 1s ease 0.5s;
}

.section-title.visible {
  opacity: 1;
  transform: translateY(0);
}

.section-title.visible::after {
  width: 120px;
}

.services-container {
  margin-bottom: 2rem;
}

.service-row {
  display: grid;
  grid-template-columns: 0.8fr 1fr 2fr;
  gap: 0;
  margin-bottom: 1rem;
  opacity: 0;
  height: 0;
  overflow: hidden;
  transition: opacity 0.5s ease, height 0.5s ease;
}

.service-row.active {
  opacity: 1;
  height: auto;
  overflow: visible;
}

.service-image-panel {
  height: 150px;
  overflow: hidden;
  position: relative;
}

.service-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.service-title-panel {
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: rgba(16, 24, 39, 0.9);
  padding: 1rem;
}

.service-title {
  font-size: 2rem;
  font-weight: 600;
  color: #f8fafc;
  margin: 0;
  text-align: center;
}

.service-details-panel {
  background-color: #111927;
  padding: 1rem 2rem;
}

.service-items {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.service-item {
  opacity: 0;
  transform: translateY(20px);
  animation: fadeInUp 0.5s forwards;
  animation-delay: var(--item-delay);
  border-left: 4px solid #3b82f6;
  padding: 0.5rem 1rem;
}

@keyframes fadeInUp {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.item-header {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-bottom: 0.5rem;
}

.item-icon {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background-color: rgba(16, 24, 39, 0.5);
  color: #3b82f6;
  flex-shrink: 0;
}

.item-title {
  font-size: 1.25rem;
  font-weight: 600;
  color: #f8fafc;
}

.item-description {
  margin: 0;
  color: #cbd5e1;
  line-height: 1.6;
  padding-left: calc(36px + 1rem);
  font-size: 1rem;
}

.navigation-controls {
  display: flex;
  justify-content: center;
  gap: 1rem;
  margin-top: 2rem;
}

.nav-dot {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background-color: rgba(203, 213, 225, 0.3);
  border: none;
  padding: 0;
  cursor: pointer;
  transition: all 0.3s ease;
}

.nav-dot.active {
  background-color: #3b82f6;
  transform: scale(1.2);
}

.nav-dot:hover {
  background-color: rgba(59, 130, 246, 0.6);
}

/* Responsive styles */
@media (max-width: 1024px) {
  .service-row {
    grid-template-columns: 1fr 1fr;
    grid-template-rows: auto auto;
  }
  
  .service-image-panel {
    grid-column: 1;
    grid-row: 1;
  }
  
  .service-title-panel {
    grid-column: 2;
    grid-row: 1;
  }
  
  .service-details-panel {
    grid-column: 1 / span 2;
    grid-row: 2;
  }
  
  .section-title {
    font-size: 2rem;
  }
}

@media (max-width: 768px) {
  .service-row {
    grid-template-columns: 1fr;
    grid-template-rows: auto auto auto;
  }
  
  .service-image-panel {
    grid-column: 1;
    grid-row: 1;
  }
  
  .service-title-panel {
    grid-column: 1;
    grid-row: 2;
  }
  
  .service-details-panel {
    grid-column: 1;
    grid-row: 3;
  }
  
  .service-title {
    font-size: 1.5rem;
  }
  
  .section-title {
    font-size: 1.8rem;
  }
}

@media (max-width: 640px) {
  .section-title {
    font-size: 1.6rem;
  }
  
  .item-title {
    font-size: 1.1rem;
  }
}
</style> 