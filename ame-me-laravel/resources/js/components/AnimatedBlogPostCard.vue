<template>
  <div 
    class="blog-card" 
    :class="{ 'featured-card': featured }"
    @mouseenter="startHoverAnimation"
    @mouseleave="endHoverAnimation"
  >
    <div class="card-image-container" :class="{ 'hover-effect': isHovering }">
      <img 
        v-if="post.featured_image" 
        :src="post.featured_image" 
        :alt="post.title" 
        class="card-image"
      >
      <div v-else class="card-image-placeholder">
        <i class="fas fa-tools"></i>
      </div>
      
      <div class="card-overlay" :class="{ 'hover-visible': isHovering }">
        <div class="card-categories">
          <span 
            v-for="category in post.categories" 
            :key="category.id" 
            class="category-badge"
          >
            {{ category.name }}
          </span>
        </div>
      </div>
    </div>
    
    <div class="card-content">
      <div class="card-meta">
        <div class="card-date">
          <i class="far fa-calendar-alt"></i>
          {{ formatDate(post.published_at) }}
        </div>
        
        <div class="card-author" v-if="post.author">
          <img 
            v-if="post.author.profile_photo_url" 
            :src="post.author.profile_photo_url" 
            :alt="post.author.name"
            class="author-avatar"
          >
          <span class="author-name">{{ post.author.name }}</span>
        </div>
      </div>
      
      <h3 class="card-title">{{ post.title }}</h3>
      
      <p class="card-excerpt">{{ post.excerpt }}</p>
      
      <div class="card-actions">
        <a :href="`/blog/${post.slug}`" class="read-more-button">
          Lire la suite
          <i class="fas fa-arrow-right"></i>
        </a>
        
        <div class="card-stats">
          <div class="stat-item" v-if="post.comments_count !== undefined">
            <i class="far fa-comment"></i>
            <span>{{ post.comments_count }}</span>
          </div>
          
          <div class="stat-item" v-if="post.likes_count !== undefined">
            <i class="far fa-heart"></i>
            <span>{{ post.likes_count }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    post: {
      type: Object,
      required: true
    },
    featured: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      isHovering: false
    };
  },
  methods: {
    formatDate(dateString) {
      if (!dateString) return '';
      
      const options = { year: 'numeric', month: 'long', day: 'numeric' };
      const date = new Date(dateString);
      
      return date.toLocaleDateString('fr-FR', options);
    },
    
    startHoverAnimation() {
      this.isHovering = true;
    },
    
    endHoverAnimation() {
      this.isHovering = false;
    }
  }
};
</script>

<style scoped>
.blog-card {
  display: flex;
  flex-direction: column;
  height: 100%;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  background-color: white;
  position: relative;
}

.blog-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
}

.featured-card {
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  border: 1px solid #e2e8f0;
}

.featured-card::before {
  content: 'À la une';
  position: absolute;
  top: 15px;
  right: -30px;
  background-color: #2842c8;
  color: white;
  padding: 5px 30px;
  transform: rotate(45deg);
  z-index: 2;
  font-size: 0.8rem;
  letter-spacing: 1px;
  text-transform: uppercase;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
}

.card-image-container {
  position: relative;
  width: 100%;
  overflow: hidden;
  height: 200px;
  transition: transform 0.6s cubic-bezier(0.25, 0.8, 0.25, 1);
}

.featured-card .card-image-container {
  height: 250px;
}

.card-image-container.hover-effect {
  transform: scale(1.03);
}

.card-image,
.card-image-placeholder {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.8s cubic-bezier(0.25, 0.8, 0.25, 1);
}

.card-image-placeholder {
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #f7fafc;
  color: #718096;
}

.card-image-placeholder i {
  font-size: 3rem;
}

.card-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.6) 90%);
  opacity: 0.8;
  transition: opacity 0.3s ease;
}

.card-overlay.hover-visible {
  opacity: 1;
}

.card-categories {
  position: absolute;
  bottom: 10px;
  left: 10px;
  display: flex;
  flex-wrap: wrap;
  gap: 5px;
}

.category-badge {
  display: inline-block;
  padding: 4px 8px;
  background-color: rgba(40, 66, 200, 0.8);
  color: white;
  border-radius: 4px;
  font-size: 0.75rem;
  font-weight: 500;
  transition: all 0.3s ease;
}

.category-badge:hover {
  background-color: rgba(40, 66, 200, 1);
}

.card-content {
  padding: 1.5rem;
  display: flex;
  flex-direction: column;
  height: 100%;
}

.card-meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 0.5rem;
  font-size: 0.9rem;
  color: #718096;
}

.card-date,
.card-author {
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.author-avatar {
  width: 24px;
  height: 24px;
  border-radius: 50%;
  object-fit: cover;
}

.card-title {
  font-size: 1.25rem;
  font-weight: 600;
  color: #2d3748;
  margin-bottom: 0.75rem;
  line-height: 1.3;
  transition: color 0.2s ease;
}

.blog-card:hover .card-title {
  color: #2842c8;
}

.featured-card .card-title {
  font-size: 1.5rem;
  margin-bottom: 1rem;
}

.card-excerpt {
  font-size: 0.95rem;
  color: #4a5568;
  margin-bottom: 1.5rem;
  line-height: 1.5;
  flex-grow: 1;
}

.card-actions {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: auto;
}

.read-more-button {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  color: #2842c8;
  font-weight: 500;
  transition: all 0.3s ease;
  text-decoration: none;
}

.read-more-button:hover {
  color: #1e36a7;
  transform: translateX(5px);
}

.read-more-button i {
  font-size: 0.8rem;
  transition: transform 0.3s ease;
}

.read-more-button:hover i {
  transform: translateX(3px);
}

.card-stats {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.stat-item {
  display: flex;
  align-items: center;
  gap: 0.25rem;
  color: #718096;
  font-size: 0.9rem;
}

@media (max-width: 768px) {
  .card-meta {
    flex-direction: column;
    align-items: flex-start;
    gap: 0.5rem;
  }
}

@media (prefers-color-scheme: dark) {
  .blog-card {
    background-color: #1e293b;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
  }
  
  .blog-card:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
  }
  
  .featured-card {
    border-color: #334155;
  }
  
  .featured-card::before {
    background-color: #60a5fa;
    color: #0f172a;
  }
  
  .card-image-placeholder {
    background-color: #0f172a;
    color: #cbd5e1;
  }
  
  .card-title {
    color: #f1f5f9;
  }
  
  .blog-card:hover .card-title {
    color: #60a5fa;
  }
  
  .card-excerpt {
    color: #cbd5e1;
  }
  
  .category-badge {
    background-color: rgba(96, 165, 250, 0.8);
    color: #0f172a;
  }
  
  .category-badge:hover {
    background-color: rgba(96, 165, 250, 1);
  }
  
  .read-more-button {
    color: #60a5fa;
  }
  
  .read-more-button:hover {
    color: #3b82f6;
  }
  
  .card-meta,
  .stat-item {
    color: #94a3b8;
  }
}
</style> 