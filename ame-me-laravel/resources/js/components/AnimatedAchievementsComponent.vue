<template>
  <section class="achievements-section">
    <div class="achievements-container">
      <h2 class="section-title" ref="sectionTitle">Our Achievements at a Glance</h2>
      
      <div class="stats-grid">
        <div 
          v-for="(stat, index) in statistics" 
          :key="index"
          class="stat-card"
          :class="{ 'visible': visibleStats.includes(index) }"
          :style="{ '--delay': `${index * 0.15}s` }"
          ref="statCards"
        >
          <div class="stat-value-container">
            <span class="stat-value">{{ stat.displayValue }}</span>
            <span class="stat-unit">{{ stat.unit }}</span>
          </div>
          <div class="stat-label">{{ stat.label }}</div>
        </div>
      </div>
      
      <div class="core-values">
        <div 
          v-for="(value, index) in coreValues" 
          :key="index"
          class="value-column"
          :class="{ 'visible': visibleValues.includes(index) }"
          :style="{ '--delay': `${index * 0.2}s` }"
          ref="valueColumns"
        >
          <h3 class="value-title">{{ value.title }}</h3>
          <div class="value-image-container">
            <img :src="value.image" :alt="value.title" class="value-image" />
            <div class="image-overlay"></div>
          </div>
          <p class="value-description">{{ value.description }}</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'AnimatedAchievementsComponent',
  data() {
    return {
      visibleStats: [],
      visibleValues: [],
      statistics: [
        { 
          value: 10, 
          displayValue: 0, 
          unit: '',
          label: '10 Years of Experience'
        },
        { 
          value: 250, 
          displayValue: 0, 
          unit: '+',
          label: 'Project Done' 
        },
        { 
          value: 100, 
          displayValue: 0, 
          unit: '%',
          label: '100% Customer Satisfaction' 
        },
        { 
          value: 2.2, 
          displayValue: 0, 
          unit: '',
          label: '$2.2 Million in Revenue' 
        }
      ],
      coreValues: [
        {
          title: 'Excellence',
          image: '/img/expertise-edited.png',
          description: 'Our commitment to excellence drives us to go beyond standard solutions, delivering superior engineering and maintenance services that stand the test of time. We continuously innovate and refine our processes to ensure the highest quality in every project.'
        },
        {
          title: 'Professionalism',
          image: '/img/proffessionalism-edited.png',
          description: 'Professionalism is the foundation of our approach. From transparent communication to timely project delivery, we uphold the highest standards, ensuring reliability and integrity in every interaction and service we provide.'
        },
        {
          title: 'Expertise',
          image: '/img/expertiseee-edited.png',
          description: 'With years of experience and specialized knowledge, our team brings expertise that you can trust. We combine technical skill with industry insights, providing solutions tailored to your needs and ensuring precision in every detail.'
        }
      ]
    };
  },
  mounted() {
    // Set up intersection observer for animation triggers
    this.setupIntersectionObserver();
    
    // Register resize listener
    window.addEventListener('resize', this.checkVisibility);
    
    // Initial check
    this.$nextTick(() => {
      this.checkVisibility();
    });
  },
  beforeDestroy() {
    // Clean up event listeners
    window.removeEventListener('resize', this.checkVisibility);
    
    // Clean up observers
    if (this.observer) {
      this.observer.disconnect();
    }
  },
  methods: {
    setupIntersectionObserver() {
      const options = {
        root: null,
        rootMargin: '0px',
        threshold: 0.2
      };
      
      this.observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const element = entry.target;
            
            // Handle different element types
            if (element === this.$refs.sectionTitle) {
              element.classList.add('visible');
            } else if (this.$refs.statCards && this.$refs.statCards.includes(element)) {
              const index = this.$refs.statCards.indexOf(element);
              if (!this.visibleStats.includes(index)) {
                this.visibleStats.push(index);
                this.animateCounter(index);
              }
            } else if (this.$refs.valueColumns && this.$refs.valueColumns.includes(element)) {
              const index = this.$refs.valueColumns.indexOf(element);
              if (!this.visibleValues.includes(index)) {
                this.visibleValues.push(index);
              }
            }
            
            // Stop observing after animation is triggered
            this.observer.unobserve(element);
          }
        });
      }, options);
      
      // Observe section title
      if (this.$refs.sectionTitle) {
        this.observer.observe(this.$refs.sectionTitle);
      }
      
      // Observe stat cards
      if (this.$refs.statCards) {
        this.$refs.statCards.forEach(card => {
          this.observer.observe(card);
        });
      }
      
      // Observe value columns
      if (this.$refs.valueColumns) {
        this.$refs.valueColumns.forEach(column => {
          this.observer.observe(column);
        });
      }
    },
    checkVisibility() {
      // Re-setup intersection observer when layout changes
      this.setupIntersectionObserver();
    },
    animateCounter(index) {
      const stat = this.statistics[index];
      const duration = 2000; // 2 seconds
      const frameDuration = 1000 / 60; // 60fps
      const totalFrames = Math.round(duration / frameDuration);
      
      // Determine the step value depending on the type of number
      let step;
      if (Number.isInteger(stat.value)) {
        step = Math.max(1, Math.floor(stat.value / totalFrames));
      } else {
        // For decimal values, use smaller steps
        step = stat.value / totalFrames;
      }
      
      let current = 0;
      const counter = setInterval(() => {
        current += step;
        
        if (current >= stat.value) {
          this.statistics[index].displayValue = stat.value;
          clearInterval(counter);
        } else {
          // Format the display value depending on the type
          if (Number.isInteger(stat.value)) {
            this.statistics[index].displayValue = Math.floor(current);
          } else {
            this.statistics[index].displayValue = parseFloat(current.toFixed(1));
          }
        }
      }, frameDuration);
    }
  }
};
</script>

<style scoped>
.achievements-section {
  padding: 5rem 0;
  background-color: #0f172a;
  color: #f8fafc;
  position: relative;
  overflow: hidden;
}

.achievements-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: radial-gradient(circle at top right, rgba(59, 130, 246, 0.15), transparent 70%);
  z-index: 0;
}

.achievements-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 2rem;
  position: relative;
  z-index: 1;
}

.section-title {
  text-align: center;
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 3.5rem;
  color: #f8fafc;
  opacity: 0;
  transform: translateY(30px);
  transition: opacity 0.8s ease, transform 0.8s ease;
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
  transition: width 0.8s ease 0.3s;
  width: 0;
}

.section-title.visible {
  opacity: 1;
  transform: translateY(0);
}

.section-title.visible::after {
  width: 100px;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 2rem;
  margin-bottom: 5rem;
}

.stat-card {
  background-color: rgba(30, 41, 59, 0.7);
  border-radius: 8px;
  padding: 2rem 1.5rem;
  text-align: center;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(5px);
  transform: translateY(30px);
  opacity: 0;
  transition: transform 0.6s ease var(--delay), 
              opacity 0.6s ease var(--delay),
              box-shadow 0.3s ease,
              background-color 0.3s ease;
}

.stat-card.visible {
  transform: translateY(0);
  opacity: 1;
}

.stat-card:hover {
  background-color: rgba(59, 130, 246, 0.2);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
  transform: translateY(-5px);
}

.stat-value-container {
  margin-bottom: 0.75rem;
}

.stat-value {
  font-size: 3rem;
  font-weight: 700;
  color: #3b82f6;
  line-height: 1;
  text-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

.stat-unit {
  font-size: 2rem;
  font-weight: 700;
  color: #3b82f6;
}

.stat-label {
  font-size: 1rem;
  color: #e2e8f0;
}

.core-values {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 2.5rem;
  margin-top: 2rem;
}

.value-column {
  transform: translateY(40px);
  opacity: 0;
  transition: transform 0.8s ease var(--delay), 
              opacity 0.8s ease var(--delay);
}

.value-column.visible {
  transform: translateY(0);
  opacity: 1;
}

.value-title {
  font-size: 1.75rem;
  font-weight: 600;
  text-align: center;
  margin-bottom: 1.5rem;
  color: #f8fafc;
  position: relative;
  display: inline-block;
}

.value-title::after {
  content: '';
  position: absolute;
  bottom: -8px;
  left: 0;
  width: 0;
  height: 2px;
  background: linear-gradient(90deg, #3b82f6, transparent);
  transition: width 1s ease-out 0.5s;
}

.value-column.visible .value-title::after {
  width: 100%;
}

.value-image-container {
  position: relative;
  margin-bottom: 1.5rem;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
  aspect-ratio: 16 / 9;
}

.value-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.7s ease;
}

.image-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(to bottom, rgba(30, 41, 59, 0.2), rgba(30, 41, 59, 0.6));
  opacity: 0.7;
  transition: opacity 0.3s ease;
}

.value-column:hover .value-image {
  transform: scale(1.1);
}

.value-column:hover .image-overlay {
  opacity: 0.4;
}

.value-description {
  font-size: 1rem;
  line-height: 1.6;
  color: #cbd5e1;
  text-align: justify;
}

/* Responsive Styles */
@media (max-width: 1024px) {
  .stats-grid {
    grid-template-columns: repeat(2, 1fr);
  }
  
  .core-values {
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
  }
  
  .value-title {
    font-size: 1.5rem;
  }
}

@media (max-width: 768px) {
  .section-title {
    font-size: 2rem;
  }
  
  .core-values {
    grid-template-columns: repeat(1, 1fr);
    gap: 3rem;
  }
  
  .value-image-container {
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
  }
  
  .value-column {
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
  }
}

@media (max-width: 640px) {
  .stats-grid {
    grid-template-columns: repeat(1, 1fr);
    gap: 1.5rem;
  }
  
  .stat-card {
    max-width: 300px;
    margin-left: auto;
    margin-right: auto;
  }
  
  .section-title {
    font-size: 1.75rem;
  }
}
</style> 