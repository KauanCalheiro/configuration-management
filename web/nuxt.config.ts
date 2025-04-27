// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },

  modules: [
    '@nuxt/ui',
    '@nuxt/eslint',
    '@nuxt/content',
    '@nuxt/fonts',
    '@nuxt/icon',
    '@nuxt/image',
    '@nuxt/scripts',
    '@nuxt/test-utils',
    'nuxt-auth-sanctum',
  ],

  plugins: [
    '~/plugins/sanctum-listener.ts',
  ],

  css: ['~/assets/css/main.css'],

  future: {
    compatibilityVersion: 4
  },

  compatibilityDate: '2024-11-27',

  colorMode: {
    preference: 'dark',
    fallback: 'dark',
  },

  app: {
    head: {
      title: 'Thorn',
      link: [
        { rel: 'icon', type: 'image/x-icon', href: '/thorn/favicon.ico', },
        { rel: 'apple-touch-icon', href: '/thorn/apple-touch-icon.png', },
      ],
    },
    baseURL: '/',
  },

  sanctum: {
    baseUrl: process.env.SANCTUM_BASE_URL,

    mode: 'token',
    userStateKey: 'sanctum.user.identity',

    endpoints: {
      csrf: '/sanctum/csrf-cookie',
      login: '/auth/login',
      logout: '/auth/logout',
      user: '/auth/user',
    },

    client: {
      retry: false,
      initialRequest: true,
    },

    redirect: {
      keepRequestedRoute: true,
      onLogin: '/',
      onLogout: '/login',
      onAuthOnly: '/login',
    },

    globalMiddleware: {
      enabled: true,
      allow404WithoutAuth: true,
    },

    logLevel: 0,
    appendPlugin: false,
  },
})
