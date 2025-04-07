<template>
  <div class="blog-container">
    <div class="blog-header" :class="{ 'animated': animateHeader }">
      <h1 class="blog-title">Blog AME Maintenance Engineering</h1>
      <p class="blog-description">Actualités, conseils techniques et études de cas sur la maintenance industrielle</p>
      
      <div class="blog-search">
        <input type="text" v-model="searchQuery" placeholder="Rechercher un article..." @keyup.enter="search">
        <button @click="search" class="search-button">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
    
    <div class="blog-categories" :class="{ 'animated': animateCategories }">
      <h3>Catégories</h3>
      <ul class="category-list">
        <li v-for="(category, index) in categories" 
            :key="category.id" 
            :class="{ 'active': activeCategoryId === category.id, 'animated': true }" 
            :style="{ 'animation-delay': index * 0.1 + 's' }">
          <a href="#" @click.prevent="filterByCategory(category.id)">
            {{ category.name }}
            <span class="post-count">({{ category.posts_count }})</span>
          </a>
        </li>
      </ul>
    </div>
    
    <div class="blog-content">
      <div class="featured-post" v-if="featuredPost" :class="{ 'animated': animateFeatured }">
        <animated-blog-post-card :post="featuredPost" :featured="true" />
      </div>
      
      <div class="posts-grid">
        <template v-if="posts.length > 0">
          <div v-for="(post, index) in posts" 
               :key="post.id" 
               class="post-grid-item" 
               :class="{ 'animated': true }"
               :style="{ 'animation-delay': index * 0.1 + 's' }">
            <animated-blog-post-card :post="post" />
          </div>
        </template>
        <div v-else class="no-posts" :class="{ 'animated': animateContent }">
          <p>Aucun article trouvé. Veuillez essayer une autre recherche ou catégorie.</p>
        </div>
      </div>
      
      <div class="blog-pagination" v-if="pagination.last_page > 1" :class="{ 'animated': animateContent }">
        <button 
          @click="changePage(pagination.current_page - 1)" 
          :disabled="pagination.current_page === 1"
          class="pagination-button"
        >
          <i class="fas fa-chevron-left"></i> Précédent
        </button>
        
        <div class="pagination-pages">
          <template v-for="(page, index) in paginationPages" :key="index">
            <button 
              v-if="page === '...'" 
              class="pagination-ellipsis" 
              disabled
            >
              ...
            </button>
            <button 
              v-else 
              @click="changePage(page)" 
              :class="['pagination-number', { 'active': page === pagination.current_page }]"
            >
              {{ page }}
            </button>
          </template>
        </div>
        
        <button 
          @click="changePage(pagination.current_page + 1)" 
          :disabled="pagination.current_page === pagination.last_page"
          class="pagination-button"
        >
          Suivant <i class="fas fa-chevron-right"></i>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import AnimatedBlogPostCard from './AnimatedBlogPostCard.vue';

export default {
  components: {
    AnimatedBlogPostCard
  },
  props: {
    initialCategories: {
      type: Array,
      default: () => []
    },
    initialPosts: {
      type: Array,
      default: () => []
    },
    initialFeaturedPost: {
      type: Object,
      default: null
    },
    initialPagination: {
      type: Object,
      default: () => ({
        current_page: 1,
        last_page: 1,
        per_page: 10,
        total: 0
      })
    }
  },
  data() {
    return {
      posts: this.initialPosts || [],
      categories: this.initialCategories || [],
      featuredPost: this.initialFeaturedPost || null,
      activeCategoryId: null,
      searchQuery: '',
      pagination: this.initialPagination || {
        current_page: 1,
        last_page: 1,
        per_page: 10,
        total: 0
      },
      loading: false,
      animateHeader: false,
      animateCategories: false,
      animateFeatured: false,
      animateContent: false
    };
  },
  computed: {
    paginationPages() {
      const { current_page, last_page } = this.pagination;
      const pages = [];
      
      if (last_page <= 7) {
        for (let i = 1; i <= last_page; i++) {
          pages.push(i);
        }
      } else {
        pages.push(1);
        
        if (current_page > 3) {
          pages.push('...');
        }
        
        const startPage = Math.max(2, current_page - 1);
        const endPage = Math.min(last_page - 1, current_page + 1);
        
        for (let i = startPage; i <= endPage; i++) {
          pages.push(i);
        }
        
        if (current_page < last_page - 2) {
          pages.push('...');
        }
        
        pages.push(last_page);
      }
      
      return pages;
    }
  },
  mounted() {
    if (this.posts.length === 0) {
      this.fetchPosts();
    }
    
    if (this.categories.length === 0) {
      this.fetchCategories();
    }
    
    // Animation timing with a staggered effect
    setTimeout(() => { this.animateHeader = true; }, 100);
    setTimeout(() => { this.animateCategories = true; }, 300);
    setTimeout(() => { this.animateFeatured = true; }, 500);
    setTimeout(() => { this.animateContent = true; }, 700);
    
    // Add intersection observer for scroll animations
    this.initIntersectionObserver();
  },
  methods: {
    fetchPosts(page = 1) {
      this.loading = true;
      
      // Simulation of API call
      // In a real app, you'd make an AJAX request to your Laravel backend
      setTimeout(() => {
        // Simulate API data
        this.posts = [
          {
            id: 1,
            title: 'Optimiser les opérations de maintenance préventive dans l\'industrie',
            slug: 'optimiser-maintenance-preventive-industrie',
            excerpt: 'Découvrez comment améliorer l\'efficacité de vos programmes de maintenance préventive pour réduire les temps d\'arrêt et prolonger la durée de vie de vos équipements industriels.',
            featured_image: '/images/blog/maintenance-preventive.jpg',
            published_at: '2024-05-18T09:30:00Z',
            likes_count: 24,
            comments_count: 8,
            author: {
              name: 'Ahmed Zakaricht',
              profile_photo_url: '/images/users/ahmed.jpg'
            },
            categories: [
              { id: 1, name: 'Maintenance', slug: 'maintenance' }
            ]
          },
          {
            id: 2,
            title: 'Les avantages de l\'automatisation dans la production industrielle',
            slug: 'avantages-automatisation-production-industrielle',
            excerpt: 'L\'automatisation des processus industriels offre de nombreux avantages en termes de productivité, de qualité et de sécurité. Voici comment l\'intégrer dans votre entreprise.',
            featured_image: '/images/blog/automatisation.jpg',
            published_at: '2024-05-15T10:30:00Z',
            likes_count: 18,
            comments_count: 3,
            author: {
              name: 'Sarah El Alaoui',
              profile_photo_url: '/images/users/sarah.jpg'
            },
            categories: [
              { id: 2, name: 'Automatisation', slug: 'automatisation' }
            ]
          },
          {
            id: 3,
            title: 'Étude de cas : Rénovation d\'une ligne de production sidérurgique',
            slug: 'etude-cas-renovation-ligne-production-siderurgique',
            excerpt: 'Découvrez comment notre équipe a relevé le défi de moderniser une ligne de production vieillissante tout en minimisant les interruptions d\'activité.',
            featured_image: '/images/blog/siderurgie.jpg',
            published_at: '2024-05-10T14:15:00Z',
            likes_count: 32,
            comments_count: 7,
            author: {
              name: 'Mehdi Tazi',
              profile_photo_url: '/images/users/mehdi.jpg'
            },
            categories: [
              { id: 3, name: 'Études de cas', slug: 'etudes-de-cas' }
            ]
          }
        ];
        
        this.featuredPost = {
          id: 4,
          title: 'Les tendances 2024 en matière de maintenance industrielle',
          slug: 'tendances-2024-maintenance-industrielle',
          excerpt: 'Le secteur de la maintenance industrielle évolue rapidement avec l\'intégration de l\'IA, l\'IoT et la réalité augmentée. Découvrez les innovations à ne pas manquer.',
          featured_image: '/images/blog/tendances.jpg',
          published_at: '2024-05-05T09:45:00Z',
          likes_count: 41,
          comments_count: 9,
          author: {
            name: 'Ahmed Zakaricht',
            profile_photo_url: '/images/users/ahmed.jpg'
          },
          categories: [
            { id: 4, name: 'Tendances', slug: 'tendances' }
          ]
        };
        
        this.pagination = {
          current_page: page,
          last_page: 5,
          per_page: 10,
          total: 48
        };
        
        this.loading = false;
      }, 800);
    },
    
    fetchCategories() {
      // Simulation de chargement des catégories
      // Dans une application réelle, vous feriez un appel AJAX à votre backend
      setTimeout(() => {
        this.categories = [
          { id: 1, name: 'Maintenance', slug: 'maintenance', posts_count: 8 },
          { id: 2, name: 'Automatisation', slug: 'automatisation', posts_count: 5 },
          { id: 3, name: 'Études de cas', slug: 'etudes-de-cas', posts_count: 3 },
          { id: 4, name: 'Tendances', slug: 'tendances', posts_count: 4 },
          { id: 5, name: 'Conseils techniques', slug: 'conseils-techniques', posts_count: 6 }
        ];
      }, 300);
    },
    
    filterByCategory(categoryId) {
      if (this.activeCategoryId === categoryId) {
        this.activeCategoryId = null;
      } else {
        this.activeCategoryId = categoryId;
      }
      
      this.searchQuery = '';
      this.fetchPosts(1);
    },
    
    search() {
      if (this.searchQuery.trim()) {
        this.activeCategoryId = null;
        this.fetchPosts(1);
      }
    },
    
    changePage(page) {
      if (page >= 1 && page <= this.pagination.last_page) {
        this.fetchPosts(page);
        
        // Scroll vers le haut de la liste des articles
        this.$nextTick(() => {
          const blogContent = document.querySelector('.blog-content');
          if (blogContent) {
            blogContent.scrollIntoView({ behavior: 'smooth' });
          }
        });
      }
    },
    
    initIntersectionObserver() {
      if ('IntersectionObserver' in window) {
        const options = {
          root: null,
          rootMargin: '0px',
          threshold: 0.1
        };
        
        const observer = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              entry.target.classList.add('in-view');
              observer.unobserve(entry.target);
            }
          });
        }, options);
        
        // Observe all post cards for scroll animation
        setTimeout(() => {
          document.querySelectorAll('.post-grid-item').forEach(item => {
            observer.observe(item);
          });
        }, 1000);
      }
    }
  }
};
</script>

<style scoped>
.blog-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 2rem 1rem;
}

.blog-header {
  text-align: center;
  margin-bottom: 3rem;
  padding-bottom: 2rem;
  border-bottom: 1px solid #e2e8f0;
  opacity: 0;
  transform: translateY(-20px);
  transition: opacity 0.6s ease, transform 0.6s ease;
}

.blog-header.animated {
  opacity: 1;
  transform: translateY(0);
}

.blog-title {
  font-size: 2.5rem;
  color: #2842c8;
  margin-bottom: 1rem;
}

.blog-description {
  font-size: 1.1rem;
  color: #4a5568;
  max-width: 800px;
  margin: 0 auto 2rem;
}

.blog-search {
  display: flex;
  max-width: 600px;
  margin: 0 auto;
}

.blog-search input {
  flex-grow: 1;
  padding: 0.75rem 1rem;
  border: 1px solid #e2e8f0;
  border-right: 0;
  border-radius: 4px 0 0 4px;
  font-size: 1rem;
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.blog-search input:focus {
  outline: none;
  border-color: #2842c8;
  box-shadow: 0 0 0 3px rgba(40, 66, 200, 0.2);
}

.search-button {
  background-color: #2842c8;
  color: white;
  border: none;
  padding: 0 1.5rem;
  border-radius: 0 4px 4px 0;
  cursor: pointer;
  transition: background-color 0.3s ease, transform 0.2s ease;
}

.search-button:hover {
  background-color: #1e36a7;
  transform: scale(1.05);
}

.blog-content {
  display: flex;
  flex-direction: column;
  gap: 2rem;
}

.blog-categories {
  margin-bottom: 2rem;
  opacity: 0;
  transform: translateY(-10px);
  transition: opacity 0.6s ease, transform 0.6s ease;
}

.blog-categories.animated {
  opacity: 1;
  transform: translateY(0);
}

.blog-categories h3 {
  font-size: 1.25rem;
  color: #2d3748;
  margin-bottom: 1rem;
}

.category-list {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  list-style: none;
  padding: 0;
}

.category-list li {
  margin-bottom: 0.5rem;
  opacity: 0;
  transform: translateX(-10px);
  transition: opacity 0.4s ease, transform 0.4s ease;
}

.category-list li.animated {
  opacity: 1;
  transform: translateX(0);
}

.category-list a {
  display: inline-block;
  padding: 0.5rem 1rem;
  background-color: #f7fafc;
  border: 1px solid #e2e8f0;
  border-radius: 4px;
  color: #4a5568;
  text-decoration: none;
  transition: all 0.3s ease;
}

.category-list li.active a {
  background-color: #2842c8;
  border-color: #2842c8;
  color: white;
}

.category-list a:hover {
  background-color: #edf2f7;
  color: #2842c8;
  transform: translateY(-2px);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.category-list li.active a:hover {
  background-color: #1e36a7;
  color: white;
}

.post-count {
  font-size: 0.8rem;
  opacity: 0.7;
  margin-left: 0.25rem;
}

.featured-post {
  margin-bottom: 2rem;
  opacity: 0;
  transform: scale(0.95);
  transition: opacity 0.8s ease, transform 0.8s ease;
}

.featured-post.animated {
  opacity: 1;
  transform: scale(1);
}

.posts-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 1.5rem;
}

.post-grid-item {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.6s ease, transform 0.6s ease;
}

.post-grid-item.animated {
  opacity: 1;
  transform: translateY(0);
}

.post-grid-item.in-view {
  opacity: 1;
  transform: translateY(0);
}

.no-posts {
  grid-column: 1 / -1;
  text-align: center;
  padding: 3rem;
  background-color: #f7fafc;
  border-radius: 8px;
  color: #4a5568;
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.6s ease, transform 0.6s ease;
}

.no-posts.animated {
  opacity: 1;
  transform: translateY(0);
}

.blog-pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 3rem;
  gap: 1rem;
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.6s ease, transform 0.6s ease;
}

.blog-pagination.animated {
  opacity: 1;
  transform: translateY(0);
}

.pagination-button {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  background-color: #f7fafc;
  border: 1px solid #e2e8f0;
  border-radius: 4px;
  color: #4a5568;
  cursor: pointer;
  transition: all 0.3s ease;
}

.pagination-button:hover:not(:disabled) {
  background-color: #edf2f7;
  color: #2842c8;
  transform: translateY(-2px);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.pagination-button:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.pagination-pages {
  display: flex;
  gap: 0.5rem;
}

.pagination-ellipsis,
.pagination-number {
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  background-color: transparent;
  border: 1px solid #e2e8f0;
  color: #4a5568;
  cursor: pointer;
  transition: all 0.3s ease;
}

.pagination-ellipsis {
  cursor: default;
}

.pagination-number:hover:not(.active) {
  background-color: #edf2f7;
  color: #2842c8;
  transform: translateY(-2px);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.pagination-number.active {
  background-color: #2842c8;
  border-color: #2842c8;
  color: white;
}

@media (max-width: 768px) {
  .blog-title {
    font-size: 2rem;
  }
  
  .blog-description {
    font-size: 1rem;
  }
  
  .posts-grid {
    grid-template-columns: 1fr;
  }
  
  .pagination-pages {
    display: none;
  }
}

@media (prefers-color-scheme: dark) {
  .blog-header {
    border-bottom-color: #334155;
  }
  
  .blog-title {
    color: #60a5fa;
  }
  
  .blog-description {
    color: #cbd5e1;
  }
  
  .blog-search input {
    background-color: #1e293b;
    border-color: #334155;
    color: #f1f5f9;
  }
  
  .blog-search input:focus {
    border-color: #60a5fa;
    box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.2);
  }
  
  .search-button {
    background-color: #60a5fa;
  }
  
  .search-button:hover {
    background-color: #3b82f6;
  }
  
  .blog-categories h3 {
    color: #f1f5f9;
  }
  
  .category-list a {
    background-color: #1e293b;
    border-color: #334155;
    color: #cbd5e1;
  }
  
  .category-list a:hover {
    background-color: #2d3748;
    color: #60a5fa;
  }
  
  .category-list li.active a {
    background-color: #60a5fa;
    border-color: #60a5fa;
    color: #0f172a;
  }
  
  .category-list li.active a:hover {
    background-color: #3b82f6;
  }
  
  .no-posts {
    background-color: #1e293b;
    color: #cbd5e1;
  }
  
  .pagination-button,
  .pagination-ellipsis,
  .pagination-number {
    background-color: #1e293b;
    border-color: #334155;
    color: #cbd5e1;
  }
  
  .pagination-button:hover:not(:disabled),
  .pagination-number:hover:not(.active) {
    background-color: #2d3748;
    color: #60a5fa;
  }
  
  .pagination-number.active {
    background-color: #60a5fa;
    border-color: #60a5fa;
    color: #0f172a;
  }
}
</style> 