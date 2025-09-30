import vue from "@vitejs/plugin-vue";
import laravel from "laravel-vite-plugin";
import { defineConfig } from "vite";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
  plugins: [
    laravel({
      input: [
        "resources/css/app.css",
        "resources/js/app.ts", // TypeScript entry point!
      ],
      refresh: true, // Full page refresh for Blade, views, routes changes
    }),
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false,
        },
      },
    }),
    tailwindcss(),
  ],
  resolve: {
    alias: {
      "@": "/resources/js", // JS/TS + Vue alias
    },
  },
  server: {
    hmr: {
      host: "localhost", // For use with Sail/WSL2!
    },
  },
});
