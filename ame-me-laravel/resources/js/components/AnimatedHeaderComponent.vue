<template>
  <header class="animated-header" :class="{ 'scrolled': hasScrolled }">
    <div class="header-container">
      <div class="logo-container" :class="{ 'visible': isVisible }">
        <div class="logo">
          <svg viewBox="0 0 220 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="logo-svg">
            <path d="M50 20L20 80H40L45 70H75L80 80H100L70 20H50Z" fill="#2842c8"/>
            <path d="M60 35L70 55H50L60 35Z" fill="#2842c8"/>
            <path d="M120 20V80H140V60H170V40H140V40H170V20H120Z" fill="#2842c8"/>
            <path d="M180 20V80H230V60H200V55H225V45H200V40H230V20H180Z" fill="#2842c8"/>
            <path d="M155 90L165 75L175 90H155Z" fill="#2842c8"/>
            <path d="M105 75L95 90H115L105 75Z" fill="#2842c8"/>
          </svg>
          <div class="gear-accent gear-small"></div>
          <div class="gear-accent gear-medium"></div>
        </div>
        <div class="logo-text">
          <div class="company-name">AME MAINTENANCE ENGINEERING</div>
          <div class="tagline">From Design to Maintenance: Complete Industrial Solutions</div>
        </div>
      </div>
      
      <nav class="main-nav" :class="{ 'visible': isVisible }">
        <ul>
          <li v-for="(item, index) in navItems" :key="index">
            <a :href="item.url" :class="{ 'active': item.active }">
              {{ item.text }}
              <span class="nav-highlight"></span>
            </a>
          </li>
        </ul>
      </nav>
      
      <button class="mobile-menu-toggle" @click="toggleMobileMenu" aria-label="Toggle menu">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
    
    <div class="mobile-nav" :class="{ 'open': mobileMenuOpen }">
      <ul>
        <li v-for="(item, index) in navItems" :key="index">
          <a :href="item.url" :class="{ 'active': item.active }" @click="closeMobileMenu">
            {{ item.text }}
          </a>
        </li>
      </ul>
    </div>
  </header>
</template>

<script>
export default {
  name: 'AnimatedHeaderComponent',
  data() {
    return {
      isVisible: false,
      hasScrolled: false,
      mobileMenuOpen: false,
      navItems: [
        { text: 'Home', url: '/', active: window.location.pathname === '/' },
        { text: 'About', url: '/about', active: window.location.pathname === '/about' },
        { text: 'Blog', url: '/blog', active: window.location.pathname.startsWith('/blog') },
        { text: 'Contact', url: '/contact', active: window.location.pathname === '/contact' },
      ]
    }
  },
  mounted() {
    // Animate header elements after component mounts
    setTimeout(() => {
      this.isVisible = true;
    }, 100);
    
    // Add scroll event listener to detect when user scrolls
    window.addEventListener('scroll', this.handleScroll);
  },
  beforeDestroy() {
    // Remove scroll listener when component is destroyed
    window.removeEventListener('scroll', this.handleScroll);
  },
  methods: {
    handleScroll() {
      if (window.scrollY > 30) {
        this.hasScrolled = true;
      } else {
        this.hasScrolled = false;
      }
    },
    toggleMobileMenu() {
      this.mobileMenuOpen = !this.mobileMenuOpen;
      document.body.style.overflow = this.mobileMenuOpen ? 'hidden' : '';
    },
    closeMobileMenu() {
      this.mobileMenuOpen = false;
      document.body.style.overflow = '';
    }
  }
}
</script>

<style scoped>
.animated-header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 1000;
  background-color: transparent;
  transition: background-color 0.3s ease, box-shadow 0.3s ease, padding 0.3s ease;
  padding: 1.5rem 0;
}

.animated-header.scrolled {
  background-color: rgba(255, 255, 255, 0.95);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
  padding: 0.75rem 0;
}

@media (prefers-color-scheme: dark) {
  .animated-header.scrolled {
    background-color: rgba(15, 23, 42, 0.95);
  }
}

.header-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 2rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.logo-container {
  display: flex;
  align-items: center;
  gap: 1rem;
  opacity: 0;
  transform: translateY(-10px);
  transition: opacity 0.8s ease, transform 0.8s ease;
}

.logo-container.visible {
  opacity: 1;
  transform: translateY(0);
}

.logo {
  position: relative;
  width: 60px;
  height: 60px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.logo-svg {
  position: relative;
  z-index: 2;
  width: 100%;
  height: 100%;
}

.gear-accent {
  position: absolute;
  border-radius: 50%;
  border: 3px solid rgba(59, 130, 246, 0.6);
  opacity: 0;
  transition: opacity 0.8s ease 0.4s, transform 0.8s ease;
}

.logo-container.visible .gear-accent {
  opacity: 1;
  animation: rotateGear 15s linear infinite;
}

.gear-small {
  width: 20px;
  height: 20px;
  top: -5px;
  right: -5px;
  border-color: rgba(16, 185, 129, 0.6);
  animation-direction: reverse !important;
  animation-duration: 10s !important;
}

.gear-medium {
  width: 25px;
  height: 25px;
  bottom: -8px;
  left: -8px;
  border-color: rgba(59, 130, 246, 0.6);
}

@keyframes rotateGear {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}

.logo-text {
  display: flex;
  flex-direction: column;
}

.company-name {
  font-weight: 700;
  font-size: 1.25rem;
  color: #1e293b;
  line-height: 1.2;
}

.tagline {
  font-size: 0.75rem;
  color: #64748b;
}

.main-nav {
  opacity: 0;
  transform: translateY(-10px);
  transition: opacity 0.8s ease 0.2s, transform 0.8s ease 0.2s;
}

.main-nav.visible {
  opacity: 1;
  transform: translateY(0);
}

.main-nav ul {
  display: flex;
  gap: 2rem;
  list-style: none;
  margin: 0;
  padding: 0;
}

.main-nav a {
  text-decoration: none;
  color: #1e293b;
  font-weight: 600;
  font-size: 1rem;
  position: relative;
  transition: color 0.3s ease;
  padding: 0.5rem 0;
}

.main-nav a:hover {
  color: #3b82f6;
}

.nav-highlight {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 2px;
  background: linear-gradient(90deg, #3b82f6, #10b981);
  transition: width 0.3s ease;
}

.main-nav a:hover .nav-highlight,
.main-nav a.active .nav-highlight {
  width: 100%;
}

.mobile-menu-toggle {
  display: none;
  flex-direction: column;
  justify-content: space-between;
  width: 30px;
  height: 20px;
  background: transparent;
  border: none;
  cursor: pointer;
  padding: 0;
  z-index: 1001;
}

.mobile-menu-toggle span {
  height: 2px;
  width: 100%;
  background-color: #1e293b;
  transition: all 0.3s ease;
}

.mobile-nav {
  position: fixed;
  top: 0;
  right: -100%;
  width: 70%;
  max-width: 350px;
  height: 100vh;
  background-color: white;
  box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
  z-index: 999;
  padding: 5rem 2rem 2rem;
  transition: right 0.3s ease;
  overflow-y: auto;
}

.mobile-nav.open {
  right: 0;
}

.mobile-nav ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

.mobile-nav li {
  margin-bottom: 1.5rem;
}

.mobile-nav a {
  text-decoration: none;
  color: #1e293b;
  font-weight: 600;
  font-size: 1.25rem;
  display: block;
  padding: 0.5rem 0;
  transition: color 0.3s ease;
}

.mobile-nav a:hover,
.mobile-nav a.active {
  color: #3b82f6;
}

/* Dark mode styles */
@media (prefers-color-scheme: dark) {
  .company-name {
    color: #f1f5f9;
  }
  
  .tagline {
    color: #94a3b8;
  }
  
  .main-nav a {
    color: #f1f5f9;
  }
  
  .mobile-menu-toggle span {
    background-color: #f1f5f9;
  }
  
  .mobile-nav {
    background-color: #1e293b;
  }
  
  .mobile-nav a {
    color: #f1f5f9;
  }
}

/* Responsive styles */
@media (max-width: 992px) {
  .company-name {
    font-size: 1rem;
  }
  
  .tagline {
    font-size: 0.7rem;
  }
  
  .main-nav ul {
    gap: 1.5rem;
  }
}

@media (max-width: 768px) {
  .main-nav {
    display: none;
  }
  
  .mobile-menu-toggle {
    display: flex;
  }
  
  .animated-header.scrolled {
    padding: 0.75rem 0;
  }
  
  .logo {
    width: 50px;
    height: 50px;
  }
  
  .mobile-nav.open + .mobile-menu-toggle span:nth-child(1) {
    transform: translateY(9px) rotate(45deg);
  }
  
  .mobile-nav.open + .mobile-menu-toggle span:nth-child(2) {
    opacity: 0;
  }
  
  .mobile-nav.open + .mobile-menu-toggle span:nth-child(3) {
    transform: translateY(-9px) rotate(-45deg);
  }
}

@media (max-width: 480px) {
  .tagline {
    display: none;
  }
  
  .header-container {
    padding: 0 1rem;
  }
}
</style> 