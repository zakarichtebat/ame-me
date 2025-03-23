<template>
  <section class="maintenance-section">
    <div class="container">
      <h2 class="section-title" :class="{ 'visible': titleVisible }" ref="sectionTitle">
        „Expert Maintenance Services for Optimal Machine Efficiency and Longevity"
      </h2>
      
      <div class="services-container">
        <div class="service-cards" :style="{ transform: `translateX(${-activeIndex * 33.33}%)` }">
          <!-- Foundry Card -->
          <div class="service-card">
            <div class="card-front">
              <div class="service-image">
                <img :src="foundryImage" alt="Foundry" />
                <div class="image-overlay"></div>
              </div>
              <h3 class="service-name">Foundry</h3>
            </div>
            <div class="card-details">
              <h4 class="details-title">Foundry Maintenance</h4>
              <ul class="feature-list">
                <li class="feature-item" v-for="(feature, index) in foundryFeatures" :key="index">
                  <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                  </div>
                  <span v-html="feature"></span>
                </li>
              </ul>
            </div>
          </div>
          
          <!-- Welding Card -->
          <div class="service-card">
            <div class="card-front">
              <div class="service-image">
                <img :src="weldingImage" alt="Welding" />
                <div class="image-overlay"></div>
              </div>
              <h3 class="service-name">Welding</h3>
            </div>
            <div class="card-details">
              <h4 class="details-title">Welding Maintenance</h4>
              <ul class="feature-list">
                <li class="feature-item" v-for="(feature, index) in weldingFeatures" :key="index">
                  <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                  </div>
                  <span v-html="feature"></span>
                </li>
              </ul>
            </div>
          </div>
          
          <!-- Diagnostic Card -->
          <div class="service-card">
            <div class="card-front">
              <div class="service-image">
                <img :src="diagnosticImage" alt="Diagnostic" />
                <div class="image-overlay"></div>
              </div>
              <h3 class="service-name">Diagnostic</h3>
            </div>
            <div class="card-details">
              <h4 class="details-title">Diagnostic Services</h4>
              <ul class="feature-list">
                <li class="feature-item" v-for="(feature, index) in diagnosticFeatures" :key="index">
                  <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                  </div>
                  <span v-html="feature"></span>
                </li>
              </ul>
            </div>
          </div>
        </div>
        
        <!-- Service navigation -->
        <div class="service-navigation">
          <button 
            v-for="(service, index) in serviceNames" 
            :key="index"
            class="nav-button"
            :class="{ 'active': activeIndex === index }"
            @click="setActiveService(index)"
          >
            {{ service }}
          </button>
        </div>
        
        <!-- Service indicators -->
        <div class="service-indicators">
          <span 
            v-for="(service, index) in serviceNames" 
            :key="index"
            class="indicator"
            :class="{ 'active': activeIndex === index }"
            @click="setActiveService(index)"
          ></span>
        </div>
      </div>
    </div>
    
    <!-- Learn More Accordion -->
    <div class="learn-more-accordion" :class="{ 'expanded': isAccordionExpanded }">
      <div class="accordion-header" @click="toggleAccordion">
        <span class="accordion-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" :style="{ transform: isAccordionExpanded ? 'rotate(180deg)' : 'rotate(0)' }">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
        </span>
        <span class="accordion-title">Learn more...</span>
      </div>
      
      <div class="accordion-content" v-if="isAccordionExpanded">
        <div class="service-details-expanded">
          <div class="service-section" v-if="activeIndex === 0">
            <h3 class="section-subtitle">Foundry Maintenance</h3>
            <ul class="expanded-feature-list">
              <li class="expanded-feature">
                <strong>Regular Inspection & Upkeep:</strong> Ensuring all foundry equipment operates smoothly with minimal downtime.
              </li>
              <li class="expanded-feature">
                <strong>Heat-Resistant Repairs:</strong> Specialized repairs using heat-resistant materials for high-performance durability.
              </li>
              <li class="expanded-feature">
                <strong>Safety & Compliance:</strong> Maintaining strict safety standards to protect workers and meet industry regulations.
              </li>
            </ul>
          </div>
          
          <div class="service-section" v-if="activeIndex === 1">
            <h3 class="section-subtitle">Welding Maintenance</h3>
            <ul class="expanded-feature-list">
              <li class="expanded-feature">
                <strong>Precision Welding Repairs:</strong> Expert welders restore equipment to optimal condition with precision welding techniques.
              </li>
              <li class="expanded-feature">
                <strong>Corrosion Protection:</strong> Applying protective coatings to prevent corrosion and extend equipment life.
              </li>
              <li class="expanded-feature">
                <strong>Quality Assurance:</strong> Regular quality checks to ensure welding integrity and high performance under demanding conditions.
              </li>
            </ul>
          </div>
          
          <div class="service-section" v-if="activeIndex === 2">
            <h3 class="section-subtitle">Diagnostic Services</h3>
            <ul class="expanded-feature-list">
              <li class="expanded-feature">
                <strong>Detailed Reporting:</strong> Providing comprehensive diagnostic reports for clear, actionable insights into equipment health.
              </li>
              <li class="expanded-feature">
                <strong>Advanced Equipment Analysis:</strong> Using state-of-the-art diagnostic tools to identify potential issues early.
              </li>
              <li class="expanded-feature">
                <strong>Predictive Maintenance:</strong> Implementing predictive maintenance to prevent unexpected breakdowns.
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import foundryImage from '../components/image/expertise-edited.png';
import weldingImage from '../components/image/proffessionalism-edited.png';
import diagnosticImage from '../components/image/expertiseee-edited.png';

export default {
  name: 'AnimatedMaintenanceServicesComponent',
  data() {
    return {
      activeIndex: 0,
      isAccordionExpanded: false,
      titleVisible: false,
      foundryImage,
      weldingImage,
      diagnosticImage,
      serviceNames: ['Foundry', 'Welding', 'Diagnostic'],
      foundryFeatures: [
        '<strong>Regular Inspection & Upkeep</strong>',
        '<strong>Heat-Resistant Repairs</strong>',
        '<strong>Safety & Compliance</strong>'
      ],
      weldingFeatures: [
        '<strong>Precision Welding Repairs</strong>',
        '<strong>Corrosion Protection</strong>',
        '<strong>Quality Assurance</strong>'
      ],
      diagnosticFeatures: [
        '<strong>Detailed Reporting</strong>',
        '<strong>Advanced Equipment Analysis</strong>',
        '<strong>Predictive Maintenance</strong>'
      ]
    };
  },
  mounted() {
    this.setupTitleObserver();
    
    // Auto-rotate services every 5 seconds
    this.autoRotateInterval = setInterval(() => {
      this.nextService();
    }, 5000);
  },
  beforeUnmount() {
    clearInterval(this.autoRotateInterval);
  },
  methods: {
    setActiveService(index) {
      this.activeIndex = index;
      
      // Reset auto-rotate timer when user manually changes service
      clearInterval(this.autoRotateInterval);
      this.autoRotateInterval = setInterval(() => {
        this.nextService();
      }, 5000);
    },
    nextService() {
      this.activeIndex = (this.activeIndex + 1) % this.serviceNames.length;
    },
    toggleAccordion() {
      this.isAccordionExpanded = !this.isAccordionExpanded;
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
    }
  }
};
</script>

<style scoped>
.maintenance-section {
  padding: 6rem 0;
  background-color: #0f172a;
  color: #f8fafc;
  position: relative;
  overflow: hidden;
}

.maintenance-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: radial-gradient(circle at top right, rgba(14, 165, 233, 0.08), transparent 70%);
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
  bottom: -15px;
  left: 50%;
  transform: translateX(-50%);
  width: 0;
  height: 3px;
  background: linear-gradient(90deg, #0ea5e9, #10b981);
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
  position: relative;
  overflow: hidden;
  padding: 2rem 0;
}

.service-cards {
  display: flex;
  transition: transform 0.8s cubic-bezier(0.68, -0.55, 0.27, 1.55);
}

.service-card {
  min-width: 33.33%;
  padding: 0 1rem;
  position: relative;
  perspective: 1000px;
  cursor: pointer;
  transition: all 0.3s ease;
  height: 400px;
}

.card-front,
.card-details {
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
  transition: transform 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.card-front {
  transform: rotateY(0deg);
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 15px 25px rgba(0, 0, 0, 0.3);
  background-color: #1e293b;
}

.card-details {
  transform: rotateY(180deg);
  background-color: #1e293b;
  border-radius: 12px;
  padding: 1.5rem;
  display: flex;
  flex-direction: column;
  box-shadow: 0 15px 25px rgba(0, 0, 0, 0.3);
}

.service-card:hover .card-front {
  transform: rotateY(-180deg);
}

.service-card:hover .card-details {
  transform: rotateY(0deg);
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
  background: linear-gradient(to bottom, rgba(15, 23, 42, 0), rgba(15, 23, 42, 0.8));
}

.service-name {
  padding: 1.5rem;
  font-size: 1.8rem;
  font-weight: 600;
  text-align: center;
  margin: 0;
  color: #f8fafc;
}

.details-title {
  font-size: 1.5rem;
  font-weight: 600;
  margin-top: 0;
  margin-bottom: 1.5rem;
  color: #f8fafc;
  text-align: center;
  border-bottom: 2px solid #0ea5e9;
  padding-bottom: 0.75rem;
}

.feature-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.feature-item {
  display: flex;
  align-items: center;
  margin-bottom: 1rem;
  padding: 0.75rem;
  border-radius: 6px;
  background-color: rgba(30, 41, 59, 0.6);
  transition: all 0.3s ease;
  animation: slideIn 0.5s forwards;
  animation-delay: calc(var(--index) * 0.1s);
}

.feature-item:hover {
  background-color: rgba(14, 165, 233, 0.2);
  transform: translateX(5px);
}

.feature-icon {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 24px;
  height: 24px;
  border-radius: 50%;
  background-color: rgba(14, 165, 233, 0.2);
  color: #0ea5e9;
  margin-right: 12px;
}

.feature-item span {
  color: #e2e8f0;
  font-size: 1rem;
}

.feature-item span strong {
  color: #f8fafc;
}

/* Service navigation */
.service-navigation {
  display: flex;
  justify-content: center;
  margin-top: 2rem;
  gap: 1rem;
}

.nav-button {
  padding: 0.75rem 1.5rem;
  background-color: rgba(30, 41, 59, 0.8);
  border: none;
  border-radius: 8px;
  color: #cbd5e1;
  font-size: 1rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s ease;
}

.nav-button:hover {
  background-color: rgba(14, 165, 233, 0.2);
  color: #f8fafc;
}

.nav-button.active {
  background-color: #0ea5e9;
  color: #f8fafc;
}

/* Service indicators */
.service-indicators {
  display: flex;
  justify-content: center;
  margin-top: 1.5rem;
  gap: 0.5rem;
}

.indicator {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background-color: rgba(203, 213, 225, 0.3);
  cursor: pointer;
  transition: all 0.3s ease;
}

.indicator.active {
  background-color: #0ea5e9;
  transform: scale(1.2);
}

.indicator:hover {
  background-color: rgba(14, 165, 233, 0.6);
}

/* Learn More Accordion */
.learn-more-accordion {
  max-width: 1000px;
  margin: 2rem auto 0;
  background-color: rgba(30, 41, 59, 0.6);
  border-radius: 8px;
  overflow: hidden;
  transition: all 0.3s ease;
}

.learn-more-accordion.expanded {
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

.accordion-header {
  display: flex;
  align-items: center;
  padding: 1rem 1.5rem;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.accordion-header:hover {
  background-color: rgba(30, 41, 59, 0.9);
}

.accordion-icon {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-right: 0.75rem;
  transition: transform 0.3s ease;
}

.accordion-icon svg {
  transition: transform 0.3s ease;
}

.accordion-title {
  font-size: 1rem;
  font-weight: 500;
  color: #94a3b8;
}

.accordion-content {
  padding: 0 1.5rem 1.5rem;
}

.service-details-expanded {
  padding: 1rem;
  border-radius: 8px;
  background-color: rgba(15, 23, 42, 0.5);
}

.section-subtitle {
  font-size: 1.5rem;
  font-weight: 600;
  color: #f8fafc;
  margin-top: 0;
  margin-bottom: 1.5rem;
  border-bottom: 1px solid rgba(148, 163, 184, 0.3);
  padding-bottom: 0.75rem;
}

.expanded-feature-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.expanded-feature {
  padding: 0.75rem 0;
  border-bottom: 1px solid rgba(148, 163, 184, 0.1);
  color: #cbd5e1;
}

.expanded-feature:last-child {
  border-bottom: none;
}

.expanded-feature strong {
  color: #f8fafc;
  margin-right: 0.5rem;
}

@keyframes slideIn {
  from {
    opacity: 0;
    transform: translateX(-20px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

/* Responsive styles */
@media (max-width: 1024px) {
  .service-card {
    min-width: 50%;
  }
  
  .service-cards {
    transform: translateX(calc(-50% * var(--active-index, 0)));
  }
}

@media (max-width: 768px) {
  .service-card {
    min-width: 100%;
  }
  
  .service-cards {
    transform: translateX(calc(-100% * var(--active-index, 0)));
  }
  
  .service-navigation {
    flex-wrap: wrap;
  }
  
  .section-title {
    font-size: 1.8rem;
  }
}

@media (max-width: 640px) {
  .section-title {
    font-size: 1.6rem;
  }
  
  .service-name,
  .details-title {
    font-size: 1.4rem;
  }
}
</style> 