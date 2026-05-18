<script setup>
import { Link } from '@inertiajs/vue3';

const menuItems = [
    { name: 'Home', href: '/' },
    { name: 'Contact', href: '#contact' },
    { name: 'Projects', href: '#projects' },
    { name: 'Experience', href: '#experience' },
];
</script>

<template>
    <header class="fixed header top-6 left-0 right-0 z-50 flex justify-center px-4">
        
        <nav 
            class="main_header flex items-center justify-center rounded-full shadow-2xl
                bg-gradient-to-r from-slate-900/80 to-slate-800/80
                backdrop-blur-xl
                border border-slate-700/20
                transition-all duration-300 hover:shadow-indigo-500/10"
        >
            <ul class="nav_list flex items-center justify-center">
                <li v-for="item in menuItems" :key="item.name" class="relative group">
                    
                    <Link 
                        :href="item.href" 
                        class="text_cilinder text-base font-semibold tracking-wide text-white/90 transition-colors group-hover:text-white"
                    >
                        {{ item.name }}
                    </Link>
                    
                    <span 
                        class="absolute -bottom-1.5 left-1/2 -translate-x-1/2 h-1 w-1 rounded-full bg-indigo-400 opacity-0 transition-all duration-300 group-hover:opacity-100 group-hover:scale-125"
                    ></span>
                </li>
            </ul>
        </nav>
    </header>
</template>

<style scoped>

/* Desktop Default Constraints */
.main_header {
    padding: 20px 48px; /* Equivalent to px-12 py-5 */
}

.nav_list {
    gap: 48px; /* Handles spacing dynamically instead of rigid Tailwind space-x-12 */
}

/* Responsive Scaling Layers */
@media (max-width: 768px) {
    .main_header {
        width: 100%;
        max-width: 500px; /* Limits the stretch on medium screens so it retains the capsule aesthetic */
        padding: 14px 24px; /* Softens padding to create safety space */
    }
    
    .nav_list {
        gap: 24px; /* Cuts link spacing in half so it fits standard mobile screens perfectly */
    }
    
    .text_cilinder {
        font-size: 14px; /* Clean, highly legible mobile structural font-scaling */
    }
}

@media (max-width: 400px) {
    .main_header {
        padding: 12px 16px;
    }
    
    .nav_list {
        gap: 16px; /* Tightest compact spacing safe configuration for ultra-small viewports */
    }
}
</style>