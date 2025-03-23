<template>
  <section class="about-section">
    <div class="container">
      <div class="about-header">
        <h2 class="section-title" v-motion-slide-visible-once-bottom>About AME Maintenance & Engineering SARL-AU</h2>
        <div class="title-underline" v-motion-slide-visible-once-bottom></div>
      </div>

      <div class="about-intro" v-motion-fade-visible-once>
        <p class="lead-text">
          Welcome to AME Maintenance Engineering, your trusted partner in the industrial sector. Founded over a decade ago, 
          we have established ourselves as a leading provider of innovative maintenance and engineering solutions in Morocco. 
          Our commitment to excellence and customer satisfaction drives us to deliver tailored services that meet the evolving 
          needs of our clients.
        </p>
      </div>

      <div class="mission-vision-section">
        <div class="mission-block" v-motion-slide-visible-once-left>
          <div class="icon-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mission-icon">
              <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
            </svg>
          </div>
          <h3>Our Mission</h3>
          <p>
            At AME, our mission is to enhance the operational efficiency of our clients by providing top-notch maintenance services, 
            expert engineering solutions, and exceptional support. We strive to be the go-to resource for industries seeking reliable, 
            cost-effective, and sustainable solutions.
          </p>
        </div>

        <div class="vision-block" v-motion-slide-visible-once-right>
          <div class="icon-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="vision-icon">
              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
              <circle cx="12" cy="12" r="3"></circle>
            </svg>
          </div>
          <h3>Our Vision</h3>
          <p>
            As we look to the future, AME Maintenance Engineering aims to expand our footprint in the industrial sector, 
            continuously evolving to meet the needs of our clients. We are dedicated to being a leader in maintenance and 
            engineering solutions, known for our reliability, expertise, and commitment to excellence.
          </p>
        </div>
      </div>

      <div class="expertise-section">
        <h3 class="expertise-title" v-motion-slide-visible-once-bottom>Our Expertise</h3>
        <p class="expertise-intro" v-motion-fade-visible-once>
          With a decade of experience, our team comprises highly skilled engineers, technicians, and industry experts. We specialize in:
        </p>
        
        <div class="expertise-grid">
          <div class="expertise-card" v-for="(expertise, index) in expertiseAreas" :key="index" v-motion-pop-visible-once>
            <div class="expertise-icon-wrapper">
              <component :is="expertise.icon" class="expertise-icon"></component>
            </div>
            <h4>{{ expertise.title }}</h4>
            <p>{{ expertise.description }}</p>
          </div>
        </div>
      </div>

      <div class="values-approach-container">
        <div class="values-section" v-motion-slide-visible-once-left>
          <h3>Our Values</h3>
          <ul class="values-list">
            <li v-for="(value, index) in companyValues" :key="index" v-motion-slide-visible-once-bottom :delay="100 * index">
              <div class="value-marker"></div>
              <div class="value-content">
                <h4>{{ value.title }}</h4>
                <p>{{ value.description }}</p>
              </div>
            </li>
          </ul>
        </div>

        <div class="approach-section" v-motion-slide-visible-once-right>
          <h3>Our Approach</h3>
          <p>
            We believe that collaboration is key to success. Our approach involves working closely with our clients to fully 
            understand their unique challenges and objectives. We conduct thorough assessments and develop customized solutions 
            that not only address immediate issues but also contribute to long-term success.
          </p>
          <h4 class="quality-title">Commitment to Quality</h4>
          <p>
            Quality is at the heart of everything we do. We adhere to the highest industry standards and best practices to ensure 
            that our services consistently exceed expectations. Our commitment to safety and sustainability drives us to implement 
            processes that protect both our clients and the environment.
          </p>
        </div>
      </div>

      <div class="cta-section" v-motion-fade-visible-once>
        <h3>Get in Touch</h3>
        <p>
          Thank you for considering AME Maintenance Engineering as your partner in achieving operational success. 
          We invite you to reach out to us to discuss how we can assist you in your journey. 
          Together, let's build a brighter, more efficient future for your business!
        </p>
        <button class="contact-btn" v-motion-pop-visible-once>Contact Us Now</button>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'AnimatedAboutComponent',
  data() {
    return {
      expertiseAreas: [
        {
          title: 'Concept Design & Planning',
          description: 'We work closely with clients to turn innovative ideas into practical solutions with thorough assessments and precise execution.',
          icon: 'DesignIcon'
        },
        {
          title: 'Steel Construction',
          description: 'Our expertise in steel construction allows us to deliver robust and reliable structures tailored to specific requirements.',
          icon: 'ConstructionIcon'
        },
        {
          title: 'Piping & Mechanical Devices',
          description: 'We provide custom piping solutions and mechanical devices designed to optimize processes and enhance productivity.',
          icon: 'PipingIcon'
        },
        {
          title: 'Precision Machining',
          description: 'From milling and turning to gear manufacturing, we deliver precision-engineered parts for advanced engineering solutions.',
          icon: 'MachiningIcon'
        },
        {
          title: 'Expert Maintenance',
          description: 'Our comprehensive maintenance services ensure optimal efficiency and longevity of your machinery, minimizing downtime.',
          icon: 'MaintenanceIcon'
        },
        {
          title: 'Training & Consulting',
          description: 'We provide expert advice and training programs to optimize processes and equip your team with essential skills.',
          icon: 'TrainingIcon'
        }
      ],
      companyValues: [
        {
          title: 'Integrity',
          description: 'We uphold honesty and transparency in all our dealings.'
        },
        {
          title: 'Innovation',
          description: 'We continuously seek out new technologies and methodologies to improve our services.'
        },
        {
          title: 'Customer Focus',
          description: 'Our clients\' success is our priority, and we strive to build lasting relationships based on trust.'
        },
        {
          title: 'Teamwork',
          description: 'We foster a culture of cooperation, encouraging our team to share ideas and support each other.'
        }
      ]
    }
  },
  components: {
    DesignIcon: {
      template: `
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M2 3h20"></path>
          <path d="M21 3v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V3"></path>
          <path d="m7 21 5-5 5 5"></path>
        </svg>
      `
    },
    ConstructionIcon: {
      template: `
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="8" width="18" height="4" rx="1"></rect>
          <path d="M12 12v8"></path>
          <path d="M8 12v8"></path>
          <path d="M16 12v8"></path>
          <path d="M4 4v4"></path>
          <path d="M20 4v4"></path>
        </svg>
      `
    },
    PipingIcon: {
      template: `
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M3 10h18"></path>
          <path d="M3 14h18"></path>
          <path d="M10 3v18"></path>
          <path d="M14 3v18"></path>
        </svg>
      `
    },
    MachiningIcon: {
      template: `
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 22v-5"></path>
          <path d="M9 8V2"></path>
          <path d="M15 8V2"></path>
          <path d="M18 8v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V8Z"></path>
          <path d="M20 8 4 8"></path>
        </svg>
      `
    },
    MaintenanceIcon: {
      template: `
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
        </svg>
      `
    },
    TrainingIcon: {
      template: `
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 8V4H8"></path>
          <rect width="16" height="12" x="4" y="8" rx="2"></rect>
          <path d="M2 14h2"></path>
          <path d="M20 14h2"></path>
          <path d="M12 16v2"></path>
          <path d="M12 12h.01"></path>
        </svg>
      `
    }
  },
  mounted() {
    // Add any additional animation initialization if needed
  }
}
</script>

<style scoped>
.about-section {
  padding: 5rem 0;
  background-color: #f8fafc;
  overflow: hidden;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 1.5rem;
}

.about-header {
  text-align: center;
  margin-bottom: 3rem;
  position: relative;
}

.section-title {
  font-size: 2.5rem;
  color: #1e293b;
  margin-bottom: 1rem;
}

.title-underline {
  height: 4px;
  width: 80px;
  background: linear-gradient(90deg, #3b82f6, #60a5fa);
  margin: 0 auto;
  border-radius: 2px;
  transition: width 0.5s ease;
}

.about-header:hover .title-underline {
  width: 120px;
}

.about-intro {
  max-width: 800px;
  margin: 0 auto 4rem;
  text-align: center;
}

.lead-text {
  font-size: 1.125rem;
  line-height: 1.8;
  color: #475569;
}

.mission-vision-section {
  display: flex;
  gap: 2rem;
  margin-bottom: 5rem;
}

.mission-block, .vision-block {
  flex: 1;
  padding: 2rem;
  background-color: white;
  border-radius: 8px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  position: relative;
  overflow: hidden;
}

.mission-block:hover, .vision-block:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.mission-block::before, .vision-block::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 4px;
  height: 100%;
  background: linear-gradient(to bottom, #3b82f6, #60a5fa);
}

.icon-wrapper {
  width: 60px;
  height: 60px;
  background-color: rgba(59, 130, 246, 0.1);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 1.5rem;
  color: #3b82f6;
  transition: transform 0.3s ease;
}

.mission-block:hover .icon-wrapper, .vision-block:hover .icon-wrapper {
  transform: rotate(10deg);
}

.mission-block h3, .vision-block h3 {
  font-size: 1.5rem;
  color: #1e293b;
  margin-bottom: 1rem;
}

.mission-block p, .vision-block p {
  line-height: 1.6;
  color: #475569;
}

.expertise-section {
  margin-bottom: 5rem;
}

.expertise-title {
  font-size: 2rem;
  color: #1e293b;
  text-align: center;
  margin-bottom: 1rem;
}

.expertise-intro {
  max-width: 700px;
  margin: 0 auto 3rem;
  text-align: center;
  color: #475569;
  font-size: 1.125rem;
}

.expertise-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
  gap: 2rem;
}

.expertise-card {
  background-color: white;
  border-radius: 8px;
  padding: 2rem;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  position: relative;
  overflow: hidden;
}

.expertise-card::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 4px;
  background: linear-gradient(90deg, #3b82f6, #60a5fa);
  transform: scaleX(0);
  transform-origin: right;
  transition: transform 0.3s ease;
}

.expertise-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.expertise-card:hover::after {
  transform: scaleX(1);
  transform-origin: left;
}

.expertise-icon-wrapper {
  width: 50px;
  height: 50px;
  color: #3b82f6;
  margin-bottom: 1.5rem;
  transition: transform 0.3s ease;
}

.expertise-card:hover .expertise-icon-wrapper {
  transform: scale(1.1);
}

.expertise-card h4 {
  font-size: 1.25rem;
  color: #1e293b;
  margin-bottom: 0.75rem;
}

.expertise-card p {
  color: #475569;
  line-height: 1.6;
}

.values-approach-container {
  display: flex;
  gap: 3rem;
  margin-bottom: 5rem;
}

.values-section, .approach-section {
  flex: 1;
}

.values-section h3, .approach-section h3 {
  font-size: 1.75rem;
  color: #1e293b;
  margin-bottom: 1.5rem;
}

.values-list {
  list-style: none;
  padding: 0;
}

.values-list li {
  display: flex;
  margin-bottom: 1.5rem;
}

.value-marker {
  flex-shrink: 0;
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background-color: #3b82f6;
  margin-top: 6px;
  margin-right: 1rem;
  position: relative;
}

.value-marker::after {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 24px;
  height: 24px;
  border-radius: 50%;
  border: 2px solid rgba(59, 130, 246, 0.3);
  opacity: 0;
  transition: opacity 0.3s ease;
}

.values-list li:hover .value-marker::after {
  opacity: 1;
}

.value-content h4 {
  font-size: 1.25rem;
  color: #1e293b;
  margin-bottom: 0.5rem;
}

.value-content p {
  color: #475569;
  line-height: 1.6;
}

.approach-section p {
  color: #475569;
  line-height: 1.6;
  margin-bottom: 1.5rem;
}

.quality-title {
  font-size: 1.25rem;
  color: #1e293b;
  margin-bottom: 0.75rem;
  position: relative;
  display: inline-block;
}

.quality-title::after {
  content: '';
  position: absolute;
  bottom: -5px;
  left: 0;
  width: 100%;
  height: 2px;
  background: linear-gradient(90deg, #3b82f6, transparent);
}

.cta-section {
  text-align: center;
  background-color: white;
  padding: 3rem;
  border-radius: 8px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

.cta-section h3 {
  font-size: 1.75rem;
  color: #1e293b;
  margin-bottom: 1.5rem;
}

.cta-section p {
  max-width: 700px;
  margin: 0 auto 2rem;
  color: #475569;
  line-height: 1.6;
}

.contact-btn {
  background: linear-gradient(90deg, #3b82f6, #60a5fa);
  color: white;
  border: none;
  padding: 0.875rem 2rem;
  font-size: 1rem;
  font-weight: 600;
  border-radius: 4px;
  cursor: pointer;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  position: relative;
  overflow: hidden;
}

.contact-btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transform: translateX(-100%);
}

.contact-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.contact-btn:hover::before {
  transform: translateX(100%);
  transition: transform 0.6s ease;
}

@media (max-width: 992px) {
  .mission-vision-section,
  .values-approach-container {
    flex-direction: column;
  }
  
  .expertise-grid {
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  }
}

@media (max-width: 768px) {
  .section-title {
    font-size: 2rem;
  }
  
  .expertise-grid {
    grid-template-columns: 1fr;
  }
}

@media (prefers-color-scheme: dark) {
  .about-section {
    background-color: #0f172a;
  }
  
  .section-title {
    color: #f1f5f9;
  }
  
  .lead-text {
    color: #cbd5e1;
  }
  
  .mission-block, .vision-block, .expertise-card, .cta-section {
    background-color: #1e293b;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
  }
  
  .mission-block h3, .vision-block h3, .expertise-card h4, 
  .values-section h3, .approach-section h3, .value-content h4,
  .quality-title, .cta-section h3 {
    color: #f1f5f9;
  }
  
  .mission-block p, .vision-block p, .expertise-card p,
  .value-content p, .approach-section p, .cta-section p {
    color: #cbd5e1;
  }
  
  .icon-wrapper {
    background-color: rgba(59, 130, 246, 0.2);
  }
}

/* Animation utility classes */
[v-motion-slide-visible-once-bottom] {
  --motion-name: slide-from-bottom;
  --motion-duration: 0.6s;
  --motion-delay: 0.1s;
}

[v-motion-slide-visible-once-left] {
  --motion-name: slide-from-left;
  --motion-duration: 0.6s;
  --motion-delay: 0.1s;
}

[v-motion-slide-visible-once-right] {
  --motion-name: slide-from-right;
  --motion-duration: 0.6s;
  --motion-delay: 0.1s;
}

[v-motion-fade-visible-once] {
  --motion-name: fade-in;
  --motion-duration: 0.8s;
  --motion-delay: 0.1s;
}

[v-motion-pop-visible-once] {
  --motion-name: pop-in;
  --motion-duration: 0.5s;
  --motion-delay: calc(var(--motion-index, 0) * 0.05s);
}

@keyframes slide-from-bottom {
  from {
    opacity: 0;
    transform: translateY(40px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes slide-from-left {
  from {
    opacity: 0;
    transform: translateX(-40px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes slide-from-right {
  from {
    opacity: 0;
    transform: translateX(40px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes fade-in {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

@keyframes pop-in {
  0% {
    opacity: 0;
    transform: scale(0.8);
  }
  70% {
    opacity: 1;
    transform: scale(1.05);
  }
  100% {
    transform: scale(1);
  }
}

[v-motion-slide-visible-once-bottom],
[v-motion-slide-visible-once-left],
[v-motion-slide-visible-once-right],
[v-motion-fade-visible-once],
[v-motion-pop-visible-once] {
  animation-name: var(--motion-name);
  animation-duration: var(--motion-duration);
  animation-delay: var(--motion-delay);
  animation-fill-mode: both;
  animation-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
</style> 