<script setup>
import { ref, computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import Header from '@/components/Header.vue';
import axios from 'axios';

// Use Inertia's built-in form helper (handles CSRF tokens automatically)
const form = useForm({
    name: '',
    email: '',
    message: ''
});

const statusMessage = ref('');
const isError = ref(false);

const submitForm = () => {
    statusMessage.value = 'Sending...';
    isError.value = false;

    // Direct POST request using Inertia
    form.post('/contact', {
        preserveScroll: true, // Stops the page from jarringly jumping around
        onSuccess: () => {
            statusMessage.value = "Message sent successfully! 🎉";
            form.reset(); // Erases fields cleanly after success
        },
        onError: (errors) => {
            isError.value = true;
            statusMessage.value = "Oops! Please check your inputs and try again.";
            console.error(errors);
        }
    });
};
// Active toggle state for the role selection capsule pill
const activeRole = ref('graphic');

// Clean structured array matching the exact content & metrics of your services section
const services = ref([
    {
        id: 'dev',
        title: "Development",
        tech: "HTML, CSS, javascript, sql, Java, Flutter",
        experience: "experience: 1 year",
        cardClass: "bg-[#002240] border border-[#003566]/30 text-white",
        pillClass: "bg-white text-[#002240]"
    },
    {
        id: 'design',
        title: "Design",
        tech: "Photoshop, illustrator, Figma, UI design",
        experience: "experience: 3 years",
        cardClass: "bg-black border border-slate-900 text-white",
        pillClass: "bg-white text-black"
    },
    {
        id: 'motion',
        title: "Motion",
        tech: "After effects, premier pro, davinci",
        experience: "experience: 18 months",
        cardClass: "bg-[#0070f3] text-white",
        pillClass: "bg-white text-[#0070f3]"
    }
]);

// Project dataset structured to loop cleanly into your grid system
const projects = ref([
    { id: 1, title: "Crypto Dashboard", tags: ["Vue.js", "Tailwind"], image: "https://images.unsplash.com/photo-1621761191319-c6fb62004040?q=80&w=600" },
    { id: 2, title: "News Aggregator App", tags: ["Flutter", "API"], image: "https://images.unsplash.com/photo-1508098682722-e99c43a406b2?q=80&w=600" },
    { id: 3, title: "E-Commerce Concept", tags: ["Figma", "UI Design"], image: "https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=600" },
    { id: 4, title: "Brand Identity Design", tags: ["Illustrator"], image: "https://images.unsplash.com/photo-1626785774573-4b799315345d?q=80&w=600" },
    { id: 10, title: "Back To School", tags: ["Pixelap"], image: "/images/backtoschool.jpg" },
    { id: 5, title: "Mobile Banking UI", tags: ["Flutter", "Dart"], image: "https://images.unsplash.com/photo-1563013544-824ae1d704d3?q=80&w=600" },
    { id: 6, title: "3D Folder Animation", tags: ["After Effects"], image: "https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=600" },
    { id: 7, title: "November flyer", tags: ["Photoshop"], image: "/images/NOVEMBER.jpg" },
    { id: 8, title: "TGIF ", tags: ["Photoshop, Flyer"], image: "/images/tgif.png" },
    { id: 9, title: "business flyer", tags: ["Photoshop"], image: "/images/claire,s.jpg" },
    { id: 11, title: "Realestate ", tags: ["Photoshop, Design"], image: "/images/realestate.jpg" },
    { id: 12, title: "August flyer", tags: ["Photoshop"], image: "/images/AUGUST copy.jpg" },
]);

// Splitting projects dynamically into two tracks for the marquee lanes
const row1Projects = computed(() => projects.value.slice(0, Math.ceil(projects.value.length / 2)));
const row2Projects = computed(() => projects.value.slice(Math.ceil(projects.value.length / 2)));

const exploreLinks = [
    { name: 'Work', href: '#projects' },
    { name: 'About', href: '#about' },
    { name: 'Process', href: '#process' },
    { name: 'Resume (PDF)', href: '/resume.pdf' },
];

const socialLinks = [
    { name: 'GitHub', href: 'https://github.com' },
    { name: 'LinkedIn', href: 'https://linkedin.com/in/tekog-manain-7384a7336?' },
    { name: 'Dribbble / Behance', href: 'https://dribbble.com' },
    { name: 'Instagram', href: 'https://instagram.com/favourtekog?' },
];
</script>

<template>

    <Head title="Creative Portfolio" />

    <div class="min-h-screen bg-white text-white font-sans antialiased page-container">
        <main class="page-content pb-16">

            <section class="hero-section w-full px-4 sm:px-8 md:px-12 lg:px-24 relative overflow-hidden">
                <Header />

                <div class="bg-blur-logo-asset hidden sm:flex">
                    <div class="logo-inner-vector">&lt;/&gt;</div>
                </div>

                <div class="container limiter pt-32 sm:pt-40 pb-16 relative z-10">
                    <div class="hero-grid">

                        <div class="hero-left text-center md:text-left flex flex-col items-center md:items-start">
                            <h1 class="hero-title">My Portfolio</h1>
                            <p class="hero-subtitle">
                                This creative has a goal to use canvas and graphics to express feelings and pass
                                information.
                            </p>

                            <div class="role-capsule-pill flex flex-wrap justify-center gap-1 sm:gap-0">
                                <button @click="activeRole = 'graphic'"
                                    :class="['capsule-btn', { 'active-pill': activeRole === 'graphic' }]">
                                    Graphic designer
                                </button>
                                <button @click="activeRole = 'web-design'"
                                    :class="['capsule-btn', { 'active-pill': activeRole === 'web-design' }]">
                                    Web designer
                                </button>
                                <button @click="activeRole = 'web-dev'"
                                    :class="['capsule-btn', { 'active-pill': activeRole === 'web-dev' }]">
                                    Web developer
                                </button>
                            </div>
                        </div>

                        <div class="hero-right w-full mt-12 md:mt-0 flex justify-center items-center">
                            <div class="avatar-composition-canvas">
                                <div class="floating-name-tag">
                                    TEKOG FAVOUR
                                    <div class="tag-anchor-tail"></div>
                                </div>

                                <div class="avatar-photo-frame">
                                    <div
                                        class="avatar-image-placeholder overflow-hidden flex items-center justify-center">
                                        <img src="/images/verified.png" alt="Verified Portrait"
                                            class="w-full h-full object-cover">
                                    </div>
                                </div>

                                <div class="software-floating-badge badge-code">&lt;/&gt;</div>
                                <div class="software-floating-badge badge-ps">Ps</div>
                                <div class="software-floating-badge badge-ai">Ai</div>
                                <div class="software-floating-badge badge-figma">Fi</div>
                                <div class="software-floating-badge badge-lr">Lr</div>
                            </div>
                        </div>
                    </div>

                    <div class="metrics-dock-wrapper px-4">
                        <div class="metrics-dock-body">
                            <div class="metric-cell">
                                <span class="metric-num text-[#0052cc]">40+</span>
                                <span class="metric-lbl text-[#0052cc]">Clients</span>
                            </div>
                            <div class="metric-split-line"></div>
                            <div class="metric-cell">
                                <span class="metric-num text-[#0070f3]">70+</span>
                                <span class="metric-lbl text-[#0070f3]">Designs</span>
                            </div>
                            <div class="metric-split-line hidden sm:block"></div>
                            <div class="metric-cell hidden sm:flex">
                                <span class="metric-num text-slate-800">2+</span>
                                <span class="metric-lbl text-slate-500">Years Exp</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="about" class="about-section w-full px-6 py-16">
                <div class="container limiter">
                    <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-12 lg:gap-24">
                        <div class="about-left-text text-left">
                            <span class="text-xs font-bold uppercase tracking-widest text-slate-500 block mb-1">Know
                                more</span>
                            <h2 class="text-4xl md:text-5xl font-extrabold text-black tracking-tight mb-8">
                                <span class="text-[#0070f3]"> About </span> Me
                            </h2>
                            <div class="space-y-6 text-base text-black leading-relaxed max-w-xl">
                                <p>I am a passionate creative professional focused on merging artistic vision with
                                    technical precision. With years of experience across multiple disciplines, I have
                                    crafted solutions for clients spanning the tech, media, and design sectors.</p>
                                <p>My methodology integrates user-centric research, iterative design, and robust code
                                    deployment. I thrive on challenges that require strategic thinking and clean,
                                    modular execution. Let me bring clarity and impact to your next initiative.</p>
                            </div>
                        </div>

                        <div class="about-right-shapes relative flex justify-center">
                            <div class="geometric-shapes-canvas">
                                <div class="geo-box geo-box-blue-large"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="work" class="portfolio-section w-full mt-16 py-16">
                <div class="container limiter px-6 mb-12">
                    <div>
                        <h2 class="text-3xl font-extrabold tracking-tight text-black mb-2">Recent Projects</h2>
                        <div class="h-1 w-16 bg-[#0070f3] rounded-full"></div>
                    </div>
                </div>

                <div class="marquee-wrapper flex flex-col gap-8 w-full overflow-hidden select-none">
                    <div class="marquee-lane track-left">
                        <div class="marquee-content-loop">
                            <div v-for="project in row1Projects" :key="'r1-' + project.id" class="marquee-card group">
                                <div class="aspect-video w-full overflow-hidden bg-slate-900 rounded-t-2xl">
                                    <img :src="project.image" :alt="project.title"
                                        class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity duration-300">
                                </div>
                                <div class="p-5">
                                    <h3 class="text-white text-base font-bold mb-2 truncate">{{ project.title }}</h3>
                                    <div class="flex flex-wrap gap-1.5">
                                        <span v-for="tag in project.tags" :key="tag"
                                            class="text-[10px] font-semibold uppercase tracking-wider text-[#00c8ff] bg-[#001d33] px-2 py-0.5 rounded-full">
                                            {{ tag }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="marquee-content-loop" aria-hidden="true">
                            <div v-for="project in row1Projects" :key="'r1-dup-' + project.id"
                                class="marquee-card group">
                                <div class="aspect-video w-full overflow-hidden bg-slate-900 rounded-t-2xl">
                                    <img :src="project.image" :alt="project.title"
                                        class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity duration-300">
                                </div>
                                <div class="p-5">
                                    <h3 class="text-white text-base font-bold mb-2 truncate">{{ project.title }}</h3>
                                    <div class="flex flex-wrap gap-1.5">
                                        <span v-for="tag in project.tags" :key="tag"
                                            class="text-[10px] font-semibold uppercase tracking-wider text-[#00c8ff] bg-[#001d33] px-2 py-0.5 rounded-full">
                                            {{ tag }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="marquee-lane track-right">
                        <div class="marquee-content-loop">
                            <div v-for="project in row2Projects" :key="'r2-' + project.id" class="marquee-card group">
                                <div class="aspect-video w-full overflow-hidden bg-slate-900 rounded-t-2xl">
                                    <img :src="project.image" :alt="project.title"
                                        class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity duration-300">
                                </div>
                                <div class="p-5">
                                    <h3 class="text-white text-base font-bold mb-2 truncate">{{ project.title }}</h3>
                                    <div class="flex flex-wrap gap-1.5">
                                        <span v-for="tag in project.tags" :key="tag"
                                            class="text-[10px] font-semibold uppercase tracking-wider text-[#00c8ff] bg-[#001d33] px-2 py-0.5 rounded-full">
                                            {{ tag }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="marquee-content-loop" aria-hidden="true">
                            <div v-for="project in row2Projects" :key="'r2-dup-' + project.id"
                                class="marquee-card group">
                                <div class="aspect-video w-full overflow-hidden bg-slate-900 rounded-t-2xl">
                                    <img :src="project.image" :alt="project.title"
                                        class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity duration-300">
                                </div>
                                <div class="p-5">
                                    <h3 class="text-white text-base font-bold mb-2 truncate">{{ project.title }}</h3>
                                    <div class="flex flex-wrap gap-1.5">
                                        <span v-for="tag in project.tags" :key="tag"
                                            class="text-[10px] font-semibold uppercase tracking-wider text-[#00c8ff] bg-[#001d33] px-2 py-0.5 rounded-full">
                                            {{ tag }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="services" class="services-section w-full px-6 py-24">
                <div class="container limiter">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                        <div class="services-left-list space-y-12">
                            <div v-for="service in services" :key="service.id" class="flex gap-6 items-start">
                                <div class="flex-shrink-0">
                                    <div :class="['h-14 w-14 rounded-full border-4 flex items-center justify-center font-black shadow-md',
                                        service.id === 'dev' ? 'border-[#003566] bg-[#002240]' : '',
                                        service.id === 'design' ? 'border-black bg-white text-black text-xs' : '',
                                        service.id === 'motion' ? 'border-[#0052cc] bg-[#0070f3]' : ''
                                    ]">
                                        <span v-if="service.id === 'design'">●</span>
                                    </div>
                                </div>
                                <div class="flex-grow pt-1">
                                    <h3 class="text-black text-xl font-bold mb-2">{{ service.title }}</h3>
                                    <div class="space-y-2 text-sm text-slate-500">
                                        <p class="flex items-center gap-3">
                                            <span
                                                :class="['h-2 w-2 rounded-full inline-block', service.id === 'dev' ? 'bg-[#00c8ff]' : 'bg-slate-400']"></span>
                                            {{ service.tech }}
                                        </p>
                                        <p class="flex items-center gap-3">
                                            <span
                                                :class="['h-2 w-2 rounded-full inline-block', service.id === 'dev' ? 'bg-[#00c8ff]' : 'bg-slate-400']"></span>
                                            {{ service.experience }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="services-right-cards flex flex-col justify-center gap-6">
                            <div v-for="service in services" :key="service.id + '-card'"
                                :class="['p-8 rounded-[24px] shadow-xl flex items-center justify-between transition-all duration-300 hover:scale-[1.01]', service.cardClass]">
                                <div>
                                    <span
                                        :class="['inline-block px-5 py-1.5 rounded-full font-serif font-bold italic text-sm tracking-wide shadow-sm', service.pillClass]">
                                        {{ service.title }}
                                    </span>
                                </div>
                                <button
                                    class="h-12 w-12 rounded-full border-2 flex items-center justify-center transition-all duration-300"
                                    :class="service.id === 'motion' ? 'border-white/30 text-white' : 'border-slate-800 text-slate-400'">
                                    <span class="text-xl font-bold">→</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="contact" class="contact-section w-full px-6 pt-16 pb-24">
                <div class="container limiter flex flex-col gap-10 items-start">
                    <div class="contact-header-block text-left">
                        <h2 class="text-[44px] font-bold tracking-tight text-black font-sans leading-tight">
                            Leave us a Message
                        </h2>
                    </div>

                    <div class="contact-form-container w-full max-w-[620px]">
                        <form @submit.prevent="submitForm" class="flex flex-col gap-6">

                            <div class="field-group">
                                <input v-model="form.name" type="text" placeholder="Enter your Name" required
                                    class="custom-form-field w-full text-black placeholder-slate-700 outline-none transition-all">
                                <span v-if="form.errors.name" class="text-red-500 text-sm">{{ form.errors.name }}</span>
                            </div>

                            <div class="field-group">
                                <input v-model="form.email" type="email" placeholder="Enter your Email" required
                                    class="custom-form-field w-full text-black placeholder-slate-700 outline-none transition-all">
                                <span v-if="form.errors.email" class="text-red-500 text-sm">{{ form.errors.email
                                    }}</span>
                            </div>

                            <div class="field-group">
                                <textarea v-model="form.message" placeholder="Enter your Message" rows="5" required
                                    class="custom-form-field w-full text-black placeholder-slate-700 resize-none outline-none transition-all"></textarea>
                                <span v-if="form.errors.message" class="text-red-500 text-sm">{{ form.errors.message
                                    }}</span>
                            </div>

                            <div class="pt-2 flex flex-col sm:flex-row sm:items-center gap-4">
                                <button type="submit" :disabled="form.processing"
                                    class="send-msg-btn bg-white text-black font-bold text-lg rounded-xl px-9 py-3.5 tracking-tight transition-transform active:scale-[0.99] disabled:opacity-50">
                                    {{ form.processing ? 'Sending...' : 'Send Message' }}
                                </button>

                                <p v-if="statusMessage" :class="isError ? 'text-red-600' : 'text-green-600'"
                                    class="font-medium tracking-tight text-base">
                                    {{ statusMessage }}
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </main>

        <footer class="footer-wrapper w-full bg-black border-t border-slate-900 pt-12 pb-16 px-6 sm:px-12">
            <div class="limiter">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24">
                    <div class="footer-brand-column flex flex-col justify-between space-y-6">
                        <div>
                            <h2 class="text-4xl font-black text-white tracking-tight">Frick Design</h2>
                            <p class="mt-4 text-slate-400 text-sm leading-relaxed max-w-xs">
                                Building the future of the web, one frame and one line of code at a time.
                            </p>
                        </div>
                        <p class="text-slate-600 text-xs font-semibold tracking-wider uppercase">
                            Located in Buea, Cameroon
                        </p>
                    </div>

                    <div class="footer-links-column grid grid-cols-2 gap-8">
                        <div class="link-group-box">
                            <h3 class="text-slate-700 font-bold uppercase tracking-widest text-xs mb-5">Explore</h3>
                            <ul class="space-y-3.5">
                                <li v-for="link in exploreLinks" :key="link.name" class="flex items-center group">
                                    <span
                                        class="h-1 w-1 rounded-full bg-slate-800 mr-2.5 transition-colors group-hover:bg-[#0070f3]"></span>
                                    <Link :href="link.href"
                                        class="text-white text-base font-bold transition-colors group-hover:text-slate-300">
                                        {{ link.name }}
                                    </Link>
                                </li>
                            </ul>
                        </div>
                        <div class="link-group-box">
                            <h3 class="text-slate-700 font-bold uppercase tracking-widest text-xs mb-5">Social</h3>
                            <ul class="space-y-3.5">
                                <li v-for="link in socialLinks" :key="link.name" class="flex items-center group">
                                    <span
                                        class="h-1 w-1 rounded-full bg-slate-800 mr-2.5 transition-colors group-hover:bg-[#0070f3]"></span>
                                    <a :href="link.href" target="_blank"
                                        class="text-white text-base font-bold transition-colors group-hover:text-slate-300">
                                        {{ link.name }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<style scoped>
/* ==========================================================================
   PRODUCTION STYLING ARCHITECTURE (CLEANED & RESPONSIVE RECONSTRUCTED)
   ========================================================================== */

.page-container {
    overflow-x: hidden;
    width: 100%;
    position: relative;
}

.page-content {
    background: #ffffff;
}

.limiter {
    max-w: 1200px;
    margin: 0 auto;
    width: 100%;
}

.about-section,
.portfolio-section,
.services-section {
    width: 100%;
}

/* 1. HERO RESPONSIVE ARCHITECTURE */
.hero-section {
    position: relative;
    padding-top: 48px;
    padding-bottom: 64px;
    margin-bottom: 64px;
    background: radial-gradient(circle at 82% 14%, #0c355a 0%, #031424 45%, #020617 100%),
        radial-gradient(circle at 12% 52%, #0c355a 0%, #031424 50%, #020617 100%),
        radial-gradient(circle at 78% 88%, #0c355a 0%, #031424 45%, #020617 100%);
    width: 100%;
    border-bottom-right-radius: 40px;
    border-bottom-left-radius: 40px;
}

@media (min-width: 768px) {
    .hero-section {
        border-bottom-right-radius: 75px;
        border-bottom-left-radius: 75px;
    }
}

.hero-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 40px;
    align-items: center;
}

@media (min-width: 768px) {
    .hero-grid {
        grid-template-columns: 1.15fr 0.85fr;
    }
}

/* BACKGROUND BLUR ASSET */
.bg-blur-logo-asset {
    position: absolute;
    top: -30px;
    left: -40px;
    width: 260px;
    height: 260px;
    background-color: #0b1524;
    border-radius: 50%;
    align-items: center;
    justify-content: center;
    box-shadow: inset 0 0 40px rgba(0, 0, 0, 0.6), 0 20px 50px rgba(0, 0, 0, 0.5);
    filter: blur(1px);
    z-index: 2;
}

.logo-inner-vector {
    color: #10b981;
    font-weight: 900;
    font-size: 5rem;
    opacity: 0.5;
    user-select: none;
}

/* TYPOGRAPHY */
.hero-title {
    font-family: serif;
    font-size: 3rem;
    font-weight: 400;
    margin: 0;
    color: #ffffff;
    letter-spacing: -0.01em;
    line-height: 1.1;
}

@media (min-width: 640px) {
    .hero-title {
        font-size: 4.5rem;
    }
}

.hero-subtitle {
    font-size: 1.15rem;
    font-style: italic;
    color: #cbd5e1;
    max-w: 490px;
    line-height: 1.6;
    margin: 24px 0 36px 0;
    font-weight: 300;
}

.role-capsule-pill {
    display: inline-flex;
    background-color: #0070f3;
    padding: 5px;
    border-radius: 9999px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.35);
}

.capsule-btn {
    background: none;
    border: none;
    color: #ffffff;
    font-weight: 700;
    font-style: italic;
    padding: 10px 18px;
    font-size: 0.8rem;
    border-radius: 9999px;
    cursor: pointer;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
}

@media (min-width: 640px) {
    .capsule-btn {
        padding: 12px 26px;
        font-size: 0.88rem;
    }
}

.capsule-btn.active-pill {
    background-color: #000000;
    color: #ffffff;
}

/* PORTRAIT CANVAS & FLOATING BADGES */
.avatar-composition-canvas {
    position: relative;
    width: 100%;
    max-w: 400px;
    height: 380px;
    display: flex;
    justify-content: center;
    align-items: center;
}

@media (min-width: 640px) {
    .avatar-composition-canvas {
        height: 460px;
    }
}

.floating-name-tag {
    position: absolute;
    top: 15px;
    right: 10px;
    background-color: #10b981;
    color: #ffffff;
    font-weight: 700;
    font-size: 0.82rem;
    padding: 8px 22px;
    border-radius: 20px;
    letter-spacing: 0.04em;
    z-index: 35;
    box-shadow: 0 6px 14px rgba(16, 185, 129, 0.25);
}

.tag-anchor-tail {
    position: absolute;
    bottom: -4px;
    left: 24px;
    width: 9px;
    height: 9px;
    background-color: #10b981;
    transform: rotate(45deg);
}

.avatar-photo-frame {
    position: relative;
    width: 240px;
    height: 240px;
    border-radius: 50%;
    z-index: 10;
}

@media (min-width: 640px) {
    .avatar-photo-frame {
        width: 295px;
        height: 295px;
    }
}

.avatar-image-placeholder {
    width: 100%;
    height: 100%;
    background-color: #0e1e38;
    border-radius: 50%;
    border: 3px solid #00c8ff;
}

.software-floating-badge {
    position: absolute;
    width: 44px;
    height: 44px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 0.85rem;
    color: white;
    z-index: 25;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
    animation: microFloatEffect 4s ease-in-out infinite;
}

@media (min-width: 640px) {
    .software-floating-badge {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        font-size: 0.95rem;
    }
}

.badge-code {
    background-color: #1a2536;
    bottom: 110px;
    left: 15px;
    border-radius: 50%;
    color: #10b981;
    animation-delay: 0s;
}

.badge-ps {
    background-color: #001c33;
    bottom: 65px;
    left: 75px;
    color: #00c8ff;
    animation-delay: 0.5s;
}

.badge-ai {
    background-color: #2b1400;
    bottom: 95px;
    right: 20px;
    color: #ff9a00;
    animation-delay: 1s;
}

.badge-figma {
    background-color: #1e1e1e;
    bottom: 20px;
    left: 35px;
    animation-delay: 1.5s;
}

.badge-lr {
    background-color: #001f2b;
    bottom: 30px;
    right: 65px;
    color: #31c7ff;
    animation-delay: 2s;
}

@media (min-width: 640px) {
    .badge-code {
        bottom: 135px;
        left: 25px;
    }

    .badge-ps {
        bottom: 85px;
        left: 95px;
    }

    .badge-ai {
        bottom: 115px;
        right: 35px;
    }

    .badge-figma {
        bottom: 35px;
        left: 50px;
    }

    .badge-lr {
        bottom: 45px;
        right: 85px;
    }
}

@keyframes microFloatEffect {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-7px);
    }
}

/* DOCK FLOATING METRICS SYSTEM */
.metrics-dock-wrapper {
    margin-top: 64px;
    display: flex;
    justify-content: center;
    width: 100%;
    position: relative;
    z-index: 30;
}

.metrics-dock-body {
    background-color: #ffffff;
    display: flex;
    justify-content: space-around;
    align-items: center;
    width: 100%;
    max-w: 780px;
    padding: 20px 24px;
    border-radius: 30px;
    box-shadow: 0 24px 48px rgba(0, 0, 0, 0.35);
}

@media (min-width: 640px) {
    .metrics-dock-body {
        display: grid;
        grid-template-columns: 1fr auto 1fr auto 1fr;
        padding: 26px 36px;
        border-radius: 9999px;
    }
}

.metric-cell {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.metric-num {
    font-size: 1.75rem;
    font-weight: 900;
    line-height: 1;
}

.metric-lbl {
    font-size: 0.9rem;
    font-weight: 700;
    margin-top: 4px;
}

@media (min-width: 640px) {
    .metric-num {
        font-size: 2.35rem;
    }

    .metric-lbl {
        font-size: 1.1rem;
    }
}

.metric-split-line {
    width: 2px;
    height: 40px;
    background-color: #020617;
    opacity: 0.25;
}

/* 2. INFINITE MARQUEE ENGINE */
.portfolio-section {
    position: relative;
    background: linear-gradient(to bottom, #ffffff 0%, #509cff 50%, #ffffff 100%);
}

.marquee-lane {
    display: flex;
    width: 100%;
    overflow: hidden;
    gap: 24px;
}

.marquee-content-loop {
    display: flex;
    flex-shrink: 0;
    gap: 24px;
    min-width: 100%;
    justify-content: space-around;
}

.track-left .marquee-content-loop {
    animation: scrollLaneLeft 25s linear infinite;
}

.track-right .marquee-content-loop {
    animation: scrollLaneRight 25s linear infinite;
}

.marquee-lane:hover .marquee-content-loop {
    animation-play-state: paused;
}

.marquee-card {
    width: 280px;
    flex-shrink: 0;
    background-color: rgba(0, 0, 0, 0.75);
    backdrop-filter: blur(8px);
    border: 1px solid #1e293b;
    border-radius: 16px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

@media (min-width: 640px) {
    .marquee-card {
        width: 310px;
    }
}

.marquee-card:hover {
    transform: translateY(-6px);
    border-color: #0070f3;
}

@keyframes scrollLaneLeft {
    0% {
        transform: translateX(0);
    }

    100% {
        transform: translateX(calc(-100% - 24px));
    }
}

@keyframes scrollLaneRight {
    0% {
        transform: translateX(calc(-100% - 24px));
    }

    100% {
        transform: translateX(0);
    }
}

/* 3. GEOMETRIC SHAPES & DECORATIVE GRAPHICS */
.geometric-shapes-canvas {
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 300px;
}

.geo-box-blue-large {
    width: 200px;
    height: 200px;
    background-color: #0070f3;
    border-radius: 32px;
    transition: transform 0.3s ease;
}

@media (min-width: 640px) {
    .geometric-shapes-canvas {
        height: 380px;
    }

    .geo-box-blue-large {
        width: 260px;
        height: 260px;
    }
}

/* 4. CONTACT & FORM LAYOUT FLOOD */
.contact-section {
    position: relative;
    background: linear-gradient(to bottom, #ffffff 0%, #509cff 200%);
    border-bottom-left-radius: 40px;
    border-bottom-right-radius: 40px;
    overflow: hidden;
}

@media (min-width: 768px) {
    .contact-section {
        border-bottom-left-radius: 90px;
        border-bottom-right-radius: 90px;
    }
}

.custom-form-field {
    background-color: #dbdbdb;
    border: 1px solid #7e7e7e;
    border-radius: 12px;
    padding: 18px 24px;
    font-size: 1.05rem;
}

.custom-form-field:focus {
    border-color: #0070f3;
    background-color: #f1f5f9;
}

.send-msg-btn {
    border: none;
    box-shadow: 0px 10px 24px rgba(0, 112, 243, 0.3);
}

.footer-wrapper {
    border-top-left-radius: 40px;
    border-top-right-radius: 40px;
    padding-top: 75px;
}

@media (min-width: 768px) {
    .footer-wrapper {
        border-top-left-radius: 50px;
        border-top-right-radius: 50px;
    }
}
</style>