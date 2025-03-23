<template>
  <section class="contact-section">
    <div class="section-header" v-motion-slide-visible-once-bottom>
      <h2 class="section-title">Contact Us</h2>
      <div class="title-underline"></div>
    </div>

    <div class="contact-container">
      <div class="contact-info" v-motion-slide-visible-once-left>
        <div class="info-card">
          <div class="info-header">
            <div class="info-icon-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="info-icon">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
              </svg>
            </div>
            <h3>Call Us</h3>
          </div>
          <p>+212 602 355 079</p>
      
        </div>

        <div class="info-card">
          <div class="info-header">
            <div class="info-icon-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="info-icon">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                <polyline points="22,6 12,13 2,6"></polyline>
              </svg>
            </div>
            <h3>Email Us</h3>
          </div>
          <p><a href="mailto:contact@ame-engineering.ma">ame.maroc@outlook.com</a></p>
        
        </div>

        <div class="info-card">
          <div class="info-header">
            <div class="info-icon-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="info-icon">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                <circle cx="12" cy="10" r="3"></circle>
              </svg>
            </div>
            <h3>Visit Us</h3>
          </div>
          <p>Zone industrielle, N71, Nador 62702</p>
          <p>Nador, Maroc</p>
        </div>
      </div>

      <div class="contact-form-container" v-motion-slide-visible-once-right>
        <div class="form-header">
          <h3>Send us a message</h3>
          <p>Have questions or need more information? Reach out to us and we'll get back to you as soon as possible.</p>
        </div>

        <form class="contact-form" @submit.prevent="submitForm">
          <div class="form-group">
            <div class="input-group" :class="{ 'focused': focusedField === 'name', 'has-value': form.name }">
              <label for="name">Your Name</label>
              <input 
                type="text" 
                id="name" 
                v-model="form.name" 
                @focus="focusField('name')" 
                @blur="blurField"
                required
              >
              <span class="input-highlight"></span>
            </div>

            <div class="input-group" :class="{ 'focused': focusedField === 'email', 'has-value': form.email }">
              <label for="email">Your Email</label>
              <input 
                type="email" 
                id="email" 
                v-model="form.email" 
                @focus="focusField('email')" 
                @blur="blurField"
                required
              >
              <span class="input-highlight"></span>
            </div>
          </div>

          <div class="input-group" :class="{ 'focused': focusedField === 'subject', 'has-value': form.subject }">
            <label for="subject">Subject</label>
            <input 
              type="text" 
              id="subject" 
              v-model="form.subject" 
              @focus="focusField('subject')" 
              @blur="blurField"
              required
            >
            <span class="input-highlight"></span>
          </div>

          <div class="input-group" :class="{ 'focused': focusedField === 'message', 'has-value': form.message }">
            <label for="message">Your Message</label>
            <textarea 
              id="message" 
              v-model="form.message" 
              @focus="focusField('message')" 
              @blur="blurField"
              rows="5"
              required
            ></textarea>
            <span class="input-highlight"></span>
          </div>

          <button type="submit" class="submit-button" v-motion-pop-visible-once>
            <span class="button-text">Send Message</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="button-icon">
              <line x1="22" y1="2" x2="11" y2="13"></line>
              <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
            </svg>
            <span class="button-background"></span>
          </button>
        </form>
      </div>
    </div>

    <div class="map-container" v-motion-fade-visible-once>
      <h3 class="map-title">Our Location in Nador Selouane</h3>
      <div class="map">
        <iframe 
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13103.223444099506!2d-2.9338427358398394!3d35.0685369!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd77a1dd3cc8cc3d%3A0xef0cecc8d2a87ab!2sSelouane%2C%20Maroc!5e0!3m2!1sfr!2sma!4v1700000000000!5m2!1sfr!2sma" 
          width="100%" 
          height="450" 
          style="border:0;" 
          allowfullscreen="" 
          loading="lazy" 
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
        <div class="map-overlay" :class="{ 'hidden': mapInteracted }" @click="activateMap">
          <div class="overlay-content">
            <div class="overlay-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                <circle cx="12" cy="10" r="3"></circle>
              </svg>
            </div>
            <p>Click to activate the map</p>
          </div>
        </div>
      </div>
    </div>

    <div class="notification" :class="{ 'show': notification.show }">
      {{ notification.message }}
    </div>
  </section>
</template>

<script>
export default {
  name: 'AnimatedContactComponent',
  data() {
    return {
      form: {
        name: '',
        email: '',
        subject: '',
        message: ''
      },
      focusedField: null,
      mapInteracted: false,
      notification: {
        show: false,
        message: ''
      }
    }
  },
  methods: {
    focusField(field) {
      this.focusedField = field;
    },
    blurField() {
      this.focusedField = null;
    },
    activateMap() {
      this.mapInteracted = true;
    },
    submitForm() {
      // Here you would typically send the form data to your backend
      console.log('Form submitted', this.form);
      
      // Show success notification
      this.notification.message = 'Thank you! Your message has been sent.';
      this.notification.show = true;
      
      // Reset form
      this.form.name = '';
      this.form.email = '';
      this.form.subject = '';
      this.form.message = '';
      
      // Hide notification after 5 seconds
      setTimeout(() => {
        this.notification.show = false;
      }, 5000);
    }
  }
}
</script>

<style scoped>
.contact-section {
  padding: 5rem 0;
  position: relative;
}

.section-header {
  text-align: center;
  margin-bottom: 3rem;
}

.section-title {
  font-size: 2.5rem;
  font-weight: 700;
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

.section-header:hover .title-underline {
  width: 120px;
}

.contact-container {
  display: flex;
  flex-wrap: wrap;
  gap: 2rem;
  margin-bottom: 4rem;
}

.contact-info {
  flex: 1;
  min-width: 300px;
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.info-card {
  background-color: white;
  padding: 1.5rem;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.info-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
}

.info-header {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-bottom: 1rem;
}

.info-icon-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 50px;
  height: 50px;
  background-color: rgba(59, 130, 246, 0.1);
  border-radius: 50%;
  color: #3b82f6;
  transition: transform 0.3s ease;
}

.info-card:hover .info-icon-wrapper {
  transform: rotate(15deg);
}

.info-header h3 {
  font-size: 1.25rem;
  color: #1e293b;
  margin: 0;
}

.info-card p {
  margin: 0.5rem 0;
  color: #64748b;
}

.info-card a {
  color: #3b82f6;
  text-decoration: none;
  transition: color 0.3s ease;
}

.info-card a:hover {
  color: #2563eb;
  text-decoration: underline;
}

.contact-form-container {
  flex: 2;
  min-width: 450px;
}

.form-header {
  margin-bottom: 2rem;
}

.form-header h3 {
  font-size: 1.5rem;
  color: #1e293b;
  margin-bottom: 0.5rem;
}

.form-header p {
  color: #64748b;
  line-height: 1.6;
}

.contact-form {
  background-color: white;
  padding: 2rem;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.form-group {
  display: flex;
  gap: 1rem;
  margin-bottom: 1.5rem;
}

.input-group {
  position: relative;
  margin-bottom: 1.5rem;
  flex: 1;
}

.input-group label {
  position: absolute;
  left: 0;
  top: 0.75rem;
  color: #64748b;
  transition: all 0.3s ease;
  pointer-events: none;
}

.input-group.focused label,
.input-group.has-value label {
  top: -1rem;
  font-size: 0.875rem;
  color: #3b82f6;
}

.input-group input,
.input-group textarea {
  width: 100%;
  padding: 0.75rem 0;
  border: none;
  border-bottom: 2px solid #e2e8f0;
  background-color: transparent;
  color: #1e293b;
  font-size: 1rem;
  outline: none;
  transition: border-color 0.3s ease;
}

.input-group input:focus,
.input-group textarea:focus {
  border-color: #3b82f6;
}

.input-highlight {
  position: absolute;
  bottom: 0;
  left: 0;
  height: 2px;
  width: 0;
  background-color: #3b82f6;
  transition: width 0.3s ease;
}

.input-group.focused .input-highlight {
  width: 100%;
}

.submit-button {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  padding: 0.875rem 2rem;
  background: none;
  border: none;
  border-radius: 4px;
  font-size: 1rem;
  font-weight: 600;
  color: white;
  cursor: pointer;
  position: relative;
  overflow: hidden;
  z-index: 1;
  transition: transform 0.3s ease;
}

.button-background {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, #3b82f6, #60a5fa);
  z-index: -1;
  transition: transform 0.6s ease;
}

.submit-button:hover {
  transform: translateY(-3px);
}

.submit-button:hover .button-background {
  transform: scale(1.05);
}

.button-icon {
  transition: transform 0.3s ease;
}

.submit-button:hover .button-icon {
  transform: translateX(3px);
}

.map-container {
  margin-top: 4rem;
}

.map-title {
  font-size: 1.5rem;
  color: #1e293b;
  margin-bottom: 1.5rem;
  text-align: center;
}

.map {
  position: relative;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.map iframe {
  display: block;
}

.map-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.6);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: opacity 0.3s ease;
}

.map-overlay.hidden {
  opacity: 0;
  pointer-events: none;
}

.overlay-content {
  text-align: center;
  color: white;
}

.overlay-icon {
  margin-bottom: 1rem;
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.1);
  }
  100% {
    transform: scale(1);
  }
}

.notification {
  position: fixed;
  bottom: 2rem;
  right: 2rem;
  padding: 1rem 2rem;
  background-color: #10b981;
  color: white;
  border-radius: 4px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transform: translateY(100%);
  opacity: 0;
  transition: transform 0.3s ease, opacity 0.3s ease;
  z-index: 1000;
}

.notification.show {
  transform: translateY(0);
  opacity: 1;
}

/* Dark mode styles */
@media (prefers-color-scheme: dark) {
  .section-title {
    color: #f1f5f9;
  }
  
  .info-card {
    background-color: #1e293b;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
  }
  
  .info-header h3 {
    color: #f1f5f9;
  }
  
  .info-card p {
    color: #cbd5e1;
  }
  
  .form-header h3 {
    color: #f1f5f9;
  }
  
  .form-header p {
    color: #cbd5e1;
  }
  
  .contact-form {
    background-color: #1e293b;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
  }
  
  .input-group label {
    color: #94a3b8;
  }
  
  .input-group input,
  .input-group textarea {
    border-bottom-color: #475569;
    color: #f1f5f9;
  }
  
  .map-title {
    color: #f1f5f9;
  }
}

/* Responsive styles */
@media (max-width: 992px) {
  .contact-container {
    flex-direction: column;
  }
  
  .contact-info {
    flex-direction: row;
    flex-wrap: wrap;
  }
  
  .info-card {
    flex: 1;
    min-width: 220px;
  }
  
  .contact-form-container {
    min-width: 100%;
  }
}

@media (max-width: 768px) {
  .form-group {
    flex-direction: column;
  }
  
  .contact-info {
    flex-direction: column;
  }
  
  .info-card {
    width: 100%;
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
  --motion-delay: 0.1s;
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