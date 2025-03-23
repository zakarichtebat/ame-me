<template>
  <section class="services-section">
    <div class="section-container">
      <h2 class="section-title" v-intersect="onTitleIntersect" :class="{ 'visible': isTitleVisible }">
        Our Engineering Services
        <span class="title-decoration"></span>
      </h2>
      
      <div class="services-grid">
        <div 
          v-for="(service, index) in services" 
          :key="index"
          class="service-card"
          v-intersect="{ handler: onCardIntersect, options: { threshold: 0.2 } }"
          :class="{ 'visible': visibleCards.includes(index) }"
          :style="{ '--delay': `${index * 0.15}s` }"
        >
          <div class="card-inner">
            <div class="card-front">
              <div class="icon-container" :style="{ backgroundColor: service.color }">
                <svg class="service-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path v-for="path in service.icon" :d="path"></path>
                </svg>
              </div>
              <h3 class="service-title">{{ service.title }}</h3>
              <p class="service-brief">{{ service.brief }}</p>
              <span class="hover-prompt">Hover for details</span>
            </div>
            
            <div class="card-back" :style="{ backgroundColor: service.color }">
              <h3 class="back-title">{{ service.title }}</h3>
              <p class="service-description">{{ service.description }}</p>
              <ul class="service-features">
                <li v-for="(feature, i) in service.features" :key="i">
                  {{ feature }}
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      
      <div class="cta-container" v-intersect="onCtaIntersect" :class="{ 'visible': isCtaVisible }">
        <p class="cta-text">Ready to upgrade your engineering solutions?</p>
        <button class="cta-button">Request Service</button>
      </div>
    </div>
    
    <!-- Animated background elements -->
    <div class="bg-element gear-1"></div>
    <div class="bg-element gear-2"></div>
    <div class="bg-element blueprint"></div>
  </section>
</template>

<script>
export default {
  name: 'AnimatedServicesComponent',
  data() {
    return {
      isTitleVisible: false,
      isCtaVisible: false,
      visibleCards: [],
      services: [
        {
          title: 'Preventive Maintenance',
          brief: 'Proactive care for machinery',
          description: 'Our preventive maintenance services ensure your equipment operates at peak efficiency, reducing downtime and extending machinery lifespan.',
          features: [
            'Regular inspection schedules',
            'Early issue detection',
            'Performance optimization',
            'Comprehensive reporting'
          ],
          color: 'rgba(59, 130, 246, 0.9)',
          icon: ['M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z', 'M7.5 4.21l4.5 2.6 4.5-2.6', 'M7.5 19.79V14.6L3 12', 'M21 12l-4.5 2.6v5.19', 'M3.27 6.96L12 12.01l8.73-5.05', 'M12 22.08V12']
        },
        {
          title: 'Engineering Consultation',
          brief: 'Expert insights for complex challenges',
          description: 'Leverage our engineering expertise to solve complex technical problems and improve operational efficiency.',
          features: [
            'Process optimization',
            'Technical troubleshooting',
            'Custom solution design',
            'Industry-specific expertise'
          ],
          color: 'rgba(16, 185, 129, 0.9)',
          icon: ['M22 11.08V12a10 10 0 1 1-5.93-9.14', 'M22 4L12 14.01l-3-3']
        },
        {
          title: 'Equipment Installation',
          brief: 'Precise setup for optimal performance',
          description: 'Professional installation services ensuring your equipment operates safely, efficiently, and according to specifications.',
          features: [
            'Safety-first approach',
            'Manufacturer specifications adherence',
            'Integration with existing systems',
            'Performance testing'
          ],
          color: 'rgba(245, 158, 11, 0.9)',
          icon: ['M8 3v3a2 2 0 0 1-2 2H3m18 0h-3a2 2 0 0 1-2-2V3m0 18v-3a2 2 0 0 1 2-2h3M3 16h3a2 2 0 0 1 2 2v3']
        },
        {
          title: 'Machinery Repair',
          brief: 'Fast, reliable repair solutions',
          description: 'Rapid response repair services to minimize downtime and restore equipment functionality.',
          features: [
            'Emergency response team',
            'Comprehensive diagnostics',
            'Quality replacement parts',
            'Post-repair validation'
          ],
          color: 'rgba(220, 38, 38, 0.9)',
          icon: ['M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z']
        },
        {
          title: 'System Automation',
          brief: 'Smart solutions for modern industry',
          description: 'Implement cutting-edge automation systems to improve efficiency, accuracy, and reduce operational costs.',
          features: [
            'PLC programming',
            'SCADA integration',
            'IoT connectivity',
            'Remote monitoring solutions'
          ],
          color: 'rgba(124, 58, 237, 0.9)',
          icon: ['M22 12h-4l-3 9L9 3l-3 9H2']
        },
        {
          title: 'Custom Fabrication',
          brief: 'Tailored manufacturing solutions',
          description: 'Custom fabrication services for specialized components and equipment tailored to your unique operational needs.',
          features: [
            'Precision engineering',
            'Material selection expertise',
            'CAD/CAM design services',
            'Quality assurance testing'
          ],
          color: 'rgba(236, 72, 153, 0.9)',
          icon: ['M18 20V10', 'M12 20V4', 'M6 20v-6']
        }
      ]
    };
  },
  directives: {
    intersect: {
      inserted(el, binding) {
        const options = binding.value.options || { threshold: 0.5 };
        const handler = typeof binding.value === 'function' ? binding.value : binding.value.handler;
        
        const observer = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              handler(el, entry);
              // If once is true, unobserve after intersection
              if (binding.value.once !== false) {
                observer.unobserve(el);
              }
            }
          });
        }, options);
        
        observer.observe(el);
        el._observer = observer;
      },
      unbind(el) {
        if (el._observer) {
          el._observer.disconnect();
        }
      }
    }
  },
  methods: {
    onTitleIntersect(el, entry) {
      this.isTitleVisible = true;
    },
    onCardIntersect(el, entry) {
      const index = Array.from(el.parentNode.children).indexOf(el);
      if (!this.visibleCards.includes(index)) {
        this.visibleCards.push(index);
      }
    },
    onCtaIntersect(el, entry) {
      this.isCtaVisible = true;
    }
  }
}
</script>

<style scoped>
.services-section {
  position: relative;
  padding: 6rem 2rem;
  overflow: hidden;
  background-color: #f8fafc;
}

.section-container {
  position: relative;
  z-index: 2;
  max-width: 1200px;
  margin: 0 auto;
}

.section-title {
  text-align: center;
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 4rem;
  position: relative;
  opacity: 0;
  transform: translateY(30px);
  transition: opacity 0.8s ease, transform 0.8s ease;
}

.section-title.visible {
  opacity: 1;
  transform: translateY(0);
}

.title-decoration {
  position: absolute;
  bottom: -15px;
  left: 50%;
  transform: translateX(-50%);
  width: 100px;
  height: 4px;
  background: linear-gradient(90deg, #3b82f6, #10b981);
  border-radius: 2px;
}

.services-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 2rem;
  margin-bottom: 4rem;
}

.service-card {
  height: 320px;
  perspective: 1000px;
  opacity: 0;
  transform: translateY(40px);
  transition: opacity 0.6s ease, transform 0.6s ease;
  transition-delay: var(--delay, 0s);
}

.service-card.visible {
  opacity: 1;
  transform: translateY(0);
}

.card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.8s;
  transform-style: preserve-3d;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
  border-radius: 12px;
}

.service-card:hover .card-inner {
  transform: rotateY(180deg);
}

.card-front, .card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
  border-radius: 12px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding: 2rem;
}

.card-front {
  background-color: white;
}

.card-back {
  transform: rotateY(180deg);
  color: white;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.icon-container {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 1.5rem;
  color: white;
}

.service-icon {
  width: 40px;
  height: 40px;
}

.service-title {
  font-size: 1.25rem;
  font-weight: 600;
  margin-bottom: 0.75rem;
  color: #1e293b;
}

.service-brief {
  color: #64748b;
  margin-bottom: 1rem;
}

.hover-prompt {
  font-size: 0.75rem;
  color: #94a3b8;
  font-style: italic;
}

.back-title {
  font-size: 1.5rem;
  font-weight: 600;
  margin-bottom: 1rem;
  color: white;
}

.service-description {
  margin-bottom: 1rem;
  line-height: 1.5;
}

.service-features {
  text-align: left;
  padding-left: 1.5rem;
}

.service-features li {
  margin-bottom: 0.5rem;
  position: relative;
}

.service-features li::before {
  content: '✓';
  position: absolute; 
  left: -1.2rem;
}

.cta-container {
  margin-top: 4rem;
  text-align: center;
  opacity: 0;
  transform: translateY(30px);
  transition: opacity 0.8s ease, transform 0.8s ease;
}

.cta-container.visible {
  opacity: 1;
  transform: translateY(0);
}

.cta-text {
  font-size: 1.25rem;
  margin-bottom: 1.5rem;
  color: #334155;
}

.cta-button {
  padding: 0.75rem 2rem;
  background: linear-gradient(90deg, #3b82f6, #10b981);
  color: white;
  border: none;
  border-radius: 50px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.cta-button:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.3);
}

/* Background elements */
.bg-element {
  position: absolute;
  z-index: 1;
  opacity: 0.07;
}

.gear-1 {
  top: 10%;
  right: 5%;
  width: 300px;
  height: 300px;
  background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%233b82f6'%3E%3Cpath d='M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6z'/%3E%3Cpath d='M1.5 13.5h2c.3 1.3.9 2.4 1.7 3.4l-1.4 1.4 1.4 1.4 1.4-1.4c1 .8 2.1 1.4 3.4 1.7v2h2v-2c1.3-.3 2.4-.9 3.4-1.7l1.4 1.4 1.4-1.4-1.4-1.4c.8-1 1.4-2.1 1.7-3.4h2v-2h-2c-.3-1.3-.9-2.4-1.7-3.4l1.4-1.4-1.4-1.4-1.4 1.4c-1-.8-2.1-1.4-3.4-1.7v-2h-2v2c-1.3.3-2.4.9-3.4 1.7L5.2 3.2 3.8 4.6l1.4 1.4C4.4 7 3.8 8.1 3.5 9.4h-2v2z'/%3E%3C/svg%3E") no-repeat center / contain;
  animation: rotate-gear 20s linear infinite;
}

.gear-2 {
  bottom: 10%;
  left: 5%;
  width: 200px;
  height: 200px;
  background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%2310b981'%3E%3Cpath d='M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6z'/%3E%3Cpath d='M1.5 13.5h2c.3 1.3.9 2.4 1.7 3.4l-1.4 1.4 1.4 1.4 1.4-1.4c1 .8 2.1 1.4 3.4 1.7v2h2v-2c1.3-.3 2.4-.9 3.4-1.7l1.4 1.4 1.4-1.4-1.4-1.4c.8-1 1.4-2.1 1.7-3.4h2v-2h-2c-.3-1.3-.9-2.4-1.7-3.4l1.4-1.4-1.4-1.4-1.4 1.4c-1-.8-2.1-1.4-3.4-1.7v-2h-2v2c-1.3.3-2.4.9-3.4 1.7L5.2 3.2 3.8 4.6l1.4 1.4C4.4 7 3.8 8.1 3.5 9.4h-2v2z'/%3E%3C/svg%3E") no-repeat center / contain;
  animation: rotate-gear 15s linear infinite reverse;
}

.blueprint {
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cpath fill='%233b82f6' fill-opacity='0.05' d='M1 1h98v98H1V1zm2 2v94h94V3H3zm20 40h54v14H23V43zm0 2v10h50V45H23zm2 2h46v6H25v-6zm10-24h34v14H35V23zm0 2v10h30V25H35zm2 2h26v6H37v-6zm30 40h6v6h-6v-6z'/%3E%3C/svg%3E");
  opacity: 0.05;
}

@keyframes rotate-gear {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

/* Dark mode */
@media (prefers-color-scheme: dark) {
  .services-section {
    background-color: #0f172a;
  }
  
  .section-title {
    color: #f1f5f9;
  }
  
  .card-front {
    background-color: #1e293b;
  }
  
  .service-title {
    color: #f1f5f9;
  }
  
  .service-brief {
    color: #94a3b8;
  }
  
  .hover-prompt {
    color: #64748b;
  }
  
  .cta-text {
    color: #cbd5e1;
  }
}

/* Responsive design */
@media (max-width: 768px) {
  .services-section {
    padding: 4rem 1rem;
  }
  
  .section-title {
    font-size: 2rem;
    margin-bottom: 3rem;
  }
  
  .services-grid {
    grid-template-columns: 1fr;
  }
  
  .service-card {
    height: 300px;
  }
  
  .gear-1, .gear-2 {
    display: none;
  }
}
</style> 