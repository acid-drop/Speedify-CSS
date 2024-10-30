import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import path from 'path';
import fg from 'fast-glob';
import fs from 'fs-extra';
import { exec } from 'child_process'; // Import exec to run npm commands

//Define here the JS and CSS files for minification
//These will be automatically copied to the dist folder
//and also the source folder with a minimified version
const inputTargets = {
  index: path.resolve(__dirname, 'index.html'), // The main entry point  
  speed_css: path.resolve(__dirname, '../assets/speed_css/speed_css.js')
};

/**
 * Custom plugin to log copied files
 * @param {Array} copyTargets - Array of objects containing source and destination paths
 * @returns {Object} - Vite plugin object
 */
function logAndCopyFilesPlugin(copyTargets) {
  return {
    name: 'log-and-copy-files',
    // Apply the plugin during the build process
    apply: 'build',
    /**
     * Logs and copies files after the build process is complete
     */
    async closeBundle() {
      // Loop through each copy target
      for (const target of copyTargets) {
        // Get the files matching the source path
        const files = await fg(target.src, { ignore: target.ignore });
        // Loop through each file
        for (const file of files) {
          // Get the relative path of the file
          const relativePath = path.relative(path.resolve(__dirname, 'dist'), file);
          // Get the destination path
          const destFile = path.resolve(target.dest, relativePath);
          // Copy the file to the destination path
          await fs.copy(file, destFile);
          // Log the copied file
          console.log(`Copied: ${file} -> ${destFile}`);
        }
      }     
      // Run `npm run package` after the build completes
      /*exec('npm run package', (err, stdout, stderr) => {
        if (err) {
          console.error(`Error running npm run package: ${err}`);
          return;
        }
        if (stderr) {
          console.error(`npm run package error output:\n${stderr}`);
        }
      });*/ 
    }
  };
}

//Setup the array to define which files get copied where
const copyTargets = [
  {
    src: path.resolve(__dirname, 'dist/assets/**/*'),
    dest: path.resolve(__dirname, '../')
  }, {
    src: path.resolve(__dirname, 'dist/*'),
    dest: path.resolve(__dirname, '../assets'),
    ignore: ['**/vite.svg', '**/index.html']
  }
];

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    vue(),
    logAndCopyFilesPlugin(copyTargets)
  ],
  build: {
    minify: 'terser',
    terserOptions: {
      compress: true,
      mangle: {
        keep_classnames: true, // Preserve class names
      },
      output: {
        comments: false,
      },
    },
    rollupOptions: {
      input: inputTargets,
      output: {
        dir: path.resolve(__dirname, 'dist'), // Output directory for the build
        entryFileNames: (chunk) => {
          if (chunk.name === 'index') {
            return 'assets/admin/admin.min.js'; // Custom path for the index file
          }
          let name = chunk.name.replace(/_js/g, '');
          return `assets/${name}/${name}.min.js`; // Default for other files
        },
        chunkFileNames: 'chunks/[name].js',
        assetFileNames: (chunk) => {
          if (chunk.name === 'index.css') {
            return 'assets/admin/admin.min.[ext]'; // Custom path for the index file
          }
          let name = chunk.name.replace(/_css\.css/g, '');
          return `assets/${name}/${name}.min.[ext]`; // Default for other files
        }
      },
    },
  },
});