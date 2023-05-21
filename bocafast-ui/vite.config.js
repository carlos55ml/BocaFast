import { fileURLToPath, URL } from 'node:url'
import { resolve } from 'path'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [vue()],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    }
  },
  build: {
    rollupOptions: {
      input: {
        index: resolve(__dirname, './index.html'),
        bocatas: resolve(__dirname, './bocatas.html'),
        pedidos: resolve(__dirname, './pedido.html'),
        login: resolve(__dirname, './login.html'),
        register: resolve(__dirname, './register.html'),
        admin: resolve(__dirname, './admin/index.html'),
        'admin/orders': resolve(__dirname, './admin/orders/index.html'),
        'admin/orders/viewOrder': resolve(__dirname, './admin/orders/viewOrder.html'),
        'admin/pieces': resolve(__dirname, './admin/pieces/index.html'),
        'admin/pieces/piece': resolve(__dirname, './admin/pieces/piece.html'),

      },
    },
  }
})
