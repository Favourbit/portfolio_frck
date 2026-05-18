<script setup>
import { Link } from '@inertiajs/vue3';

const exploreLinks = [
    { name: 'Work', href: '#work' },
    { name: 'About', href: '#about' },
    { name: 'Process', href: '#process' },
    { name: 'Resume (PDF)', href: '/resume.pdf', isExternal: true },
];

const socialLinks = [
    { name: 'GitHub', href: 'https://github.com' },
    { name: 'LinkedIn', href: 'https://linkedin.com' },
    { name: 'Dribbble / Behance', href: 'https://dribbble.com' },
    { name: 'Instagram', href: 'https://instagram.com' },
];
</script>

<template>
    <footer class="portfolio-footer">
        <div class="footer-container">
            
            <div class="footer-column brand-column">
                <div class="brand-top">
                    <h2 class="brand-title">Frick Design</h2>
                    <p class="brand-description">
                        Building the future of the web, one frame and one line of code at a time.
                    </p>
                </div>
                <p class="brand-location">Located in Buea, Cameroon</p>
            </div>

            <div class="footer-column links-column">
                <h3 class="column-heading">Explore</h3>
                <ul class="link-list">
                    <li v-for="link in exploreLinks" :key="link.name" class="link-item">
                        <span class="custom-bullet explore-bullet"></span>
                        <a v-if="link.isExternal" :href="link.href" download class="footer-link">
                            {{ link.name }}
                        </a>
                        <Link v-else :href="link.href" class="footer-link">
                            {{ link.name }}
                        </Link>
                    </li>
                </ul>
            </div>

            <div class="footer-column links-column">
                <h3 class="column-heading">Social</h3>
                <ul class="link-list">
                    <li v-for="link in socialLinks" :key="link.name" class="link-item">
                        <span class="custom-bullet social-bullet"></span>
                        <a :href="link.href" target="_blank" class="footer-link">
                            {{ link.name }}
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </footer>
</template>

<style scoped>
.portfolio-footer {
    width: 100%;
    padding: 0px;
    margin-top: 64px;
    box-sizing: border-box;
}

/* Replicating the large rounded corner background from your image */
.footer-container {
    width: 100%;
    margin: 0px;
    background-color: #000000;
    color: #ffffff;
    border-top-left-radius: 45px;
    border-top-right-radius: 45px;
    padding: 64px;
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 32px;
    box-sizing: border-box;
}

/* Brand Column Rules */
.brand-column {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.brand-title {
    font-size: 2.25rem;
    font-weight: 800;
    letter-spacing: -0.05em;
    margin: 0;
}

.brand-description {
    margin-top: 16px;
    color: #94a3b8;
    font-size: 1rem;
    line-height: 1.6;
    max-width: 320px;
}

.brand-location {
    color: #64748b;
    font-size: 0.875rem;
    letter-spacing: 0.05em;
    margin: 32px 0 0 0;
}

/* Navigation Lists Rules */
.column-heading {
    color: #94a3b8;
    font-weight: 700;
    letter-spacing: 0.05em;
    font-size: 0.875rem;
    text-transform: uppercase;
    margin: 0 0 16px 0;
}

.link-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.link-item {
    display: flex;
    align-items: center;
    margin-bottom: 12px;
}

/* Custom CSS Bullet Points matching your design structure */
.custom-bullet {
    height: 6px;
    width: 6px;
    border-radius: 50%;
    background-color: #475569;
    margin-right: 12px;
    transition: background-color 0.3s ease;
}

.footer-link {
    color: #ffffff;
    font-weight: 700;
    font-size: 1.125rem;
    text-decoration: none;
    transition: color 0.3s ease;
}

/* Smooth Interactive Hover states */
.link-item:hover .explore-bullet {
    background-color: #818cf8; /* indigo highlight */
}
.link-item:hover .footer-link {
    color: #818cf8;
}

.link-item:hover .social-bullet {
    background-color: #f472b6; /* pink highlight */
}
.link-item:hover .links-column:last-child .footer-link {
    color: #f472b6;
}

/* Responsive breakpoint logic for mobile viewports */
@media (max-width: 768px) {
    .footer-container {
        grid-template-columns: 1fr;
        padding: 32px;
        gap: 48px;
    }
    
    .brand-location {
        margin-top: 16px;
    }
}
</style>