import type { FetchContext } from 'ofetch';
import type { ConsolaInstance } from 'consola';
import type { NuxtApp } from '#app';

export default defineAppConfig({
  // https://ui.nuxt.com/getting-started/theme#design-system
  ui: {
    colors: {
      primary: 'violet',
      neutral: 'neutral',
    },
  },

  sanctum: {
    interceptors: {
      onRequest: async (app: NuxtApp, ctx: FetchContext, logger: ConsolaInstance): Promise<void> => {
        ctx.options.credentials = 'omit'
      },
    },
  },
})

