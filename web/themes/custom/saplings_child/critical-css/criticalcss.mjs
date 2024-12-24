import * as fs from 'fs';
import {generate} from 'critical';
import log from 'fancy-log';
import logSymbols from 'log-symbols';

const criticalCssConfig = {
  concurrency: 5, // this is the number of tasks that run concurrently, large numbers could lead to errors / memory leaks
  baseUrl: `http://${process.env.VIRTUAL_HOST}`,
  criticalIgnore: ['@font-face'],
  // Add your pages here.
  // "{entity_id}.css", "{bundle_type}.css", or "{url}.css".
  // (e.g., 1234.css, article.css, my-page-url.css, etc).
  pages: [
    // Home.
    {
      url: '/node/1',
      template: 'front',
      dimensions: [
        {
          height: 640,
          width: 360,
        },
        {
          height: 940,
          width: 1350,
        },
      ],
    },
  ],
};

criticalCssConfig.pages.forEach((page) => {
  const url = `${criticalCssConfig.baseUrl + page.url}?criticalcss=false`;
  log(
    logSymbols.info,
    `Generating critical CSS for name ${page.template} with URL ${url}`,
  );
  // critical.generate returns a Promise.
  generate({
    // Inline the generated critical-path CSS
    // - true generates HTML
    // - false generates CSS
    inline: false,
    // Used to pushfalse, pass and css parsing errors.
    rebase: false,
    // Your base directory
    base: './',
    // HTML source file
    src: url,
    // Dimensions
    dimensions: page.dimensions,
    // Output results to file
    target: {
      css: `${process.env.PROJECT_ROOT}/${process.env.DOCROOT}/${process.env.THEME}/critical-css/css/${page.template}.css`,
    },
    // Ignore CSS rules.
    ignore: {
      atrule: ['@font-face'],
      // rule: [/some-regexp/],
      // decl: (node, value) => /big-image\.png/.test(value),
    },
    penthouse: {
      puppeteer: {
        args: ['--disable-gpu', '--disable-setuid-sandbox', '--no-sandbox'],
        headless: true
      }
    }
  })
  .catch((err) => {
    console.log(err);
  });
});
