const colors = require("tailwindcss/colors")
const plugin = require("tailwindcss/plugin")

module.exports = {
  content: [
    "./components/**/*.{js,vue,ts}",
    "./layouts/**/*.vue",
    "./pages/**/*.vue",
    "./plugins/**/*.{js,ts}",
    "./app.vue",
    "./error.vue",
    "./lib/forms/themes/form-themes.js",
    "./lib/forms/themes/ThemeBuilder.js",
    './data/**/*.json'
  ],
  safelist: [
    {
      pattern: /.*bg-(blue|gray|red|yellow|green).*/,
    },
    ...["green", "red", "blue", "yellow"]
      .map((color) => ["bg-" + color + "-100", "border-" + color + "-500"])
      .flat(), // Alerts
    ...["dark:hover:bg-notion-dark-light"],
  ],
  darkMode: "class", // or 'media' or 'class'
  theme: {
    extend: {
      keyframes: {
        "bonce-slow": {
          "0%, 20%": { transform: "translateY(0)" },
          "8%": { transform: "translateY(-25%)" },
          "16%": { transform: "translateY(+10%)" },
        },
        "infinite-scroll": {
          from: { transform: "translateX(0)" },
          to: { transform: "translateX(-100%)" },
        },
      },
      animation: {
        "bounce-slow": "bonce-slow 3s ease-in-out infinite",
        "infinite-scroll": "infinite-scroll 50s linear infinite",
      },
      maxHeight: {
        42: "10.5rem",
      },
      minHeight: {
        6: "1.5rem",
        8: "2rem",
      },
      maxWidth: {
        15: "15rem",
        10: "10rem",
        8: "2rem",
      },
      translate: {
        5.5: "1.4rem",
      },
      boxShadow: {
        'custom-shadow':'0px 25px 75px 0px #5353531A'
      },
      colors: {
        gray: colors.slate,
        "nt-blue": {
          lighter: colors.blue["100"],
          light: colors.blue["300"],
          default: colors.blue["600"],
          DEFAULT: colors.blue["600"],
          dark: colors.blue["800"],
        },
        "notion-dark": {
          DEFAULT: "#191919",
          light: "#2e2e2e",
        },
        "notion-input": {
          background: "#F7F6F3",
          backgroundDark: "#272B2C",
          help: "#37352f99",
          helpDark: "#fff9",
          border: 'rgba(15, 15, 15, 0.1)',
          borderDark: 'rgba(255, 255, 255, 0.1)'
        },
        "form-color": "var(--bg-form-color)",
        'primary': {
          50: 'oklch(88.77% 0.05 4.09deg)',
          100: 'oklch(80.79% 0.08 6.87deg)',
          200: 'oklch(73.29% 0.12 8.7deg)',
          300: 'oklch(66.1% 0.16 11.19deg)',
          400: 'oklch(60.23% 0.19 14.66deg)',
          500: 'oklch(55.66% 0.21 19.69deg)',
          600: 'oklch(51.01% 0.19 19.73deg)',
          700: 'oklch(46.02% 0.17 19.15deg)',
          800: 'oklch(41.13% 0.16 19.13deg)',
          900: 'oklch(35.84% 0.14 18.21deg)',
          950: 'oklch(30.49% 0.12 17.61deg)',
        },
        'secondary': {
          50: 'oklch(92.61% 0.03 229.18deg)',
          100: 'oklch(86.12% 0.04 231.04deg)',
          200: 'oklch(79.39% 0.05 235.36deg)',
          300: 'oklch(72.78% 0.07 235.94deg)',
          400: 'oklch(65.93% 0.08 238.76deg)',
          500: 'oklch(59.25% 0.09 239.65deg)',
          600: 'oklch(54.31% 0.08 238.91deg)',
          700: 'oklch(49.3% 0.07 238.83deg)',
          800: 'oklch(43.86% 0.07 239.28deg)',
          900: 'oklch(38.56% 0.06 239.23deg)',
          950: 'oklch(33.01% 0.05 237.77deg)',
        },
      },
      fontFamily: {
        sans: ['Avenir', 'Montserrat', 'Corbel', 'URW Gothic', 'source-sans-pro', 'sans-serif'],
        heading: ['Avenir', 'Montserrat', 'Corbel', 'URW Gothic', 'source-sans-pro', 'sans-serif'],
      },
      borderRadius: {
        'base': '0.375rem',
        'container': '0.75rem',
      },
      spacing: {
        'base': '0.25rem',
      },
      transitionProperty: {
        height: "height",
        width: "width",
        maxWidth: "max-width",
        spacing: "margin, padding",
      },
    },
  },
  plugins: [
    require("@tailwindcss/aspect-ratio"),
    plugin(function ({ addVariant }) {
      addVariant("between", "&:not(:first-child):not(:last-child)")
      addVariant("hocus", ["&:hover", "&:focus"])
      // Add a new variant that only applies when there's no RTL parent
      addVariant('ltr-only', '&:where(:not([dir="rtl"] *))')
    }),
  ],
}
