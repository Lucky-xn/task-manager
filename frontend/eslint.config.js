import js from "@eslint/js";
import globals from "globals";
import pluginVue from "eslint-plugin-vue";
import { defineConfig } from "eslint/config";

export default defineConfig([
  {
    files: ["**/*.js", "**/*.cjs", "**/*.mjs", "**/*.vue"],
    rules: {
      "prefer-const": "warn",
      "no-constant-binary-expression": "error",
    },
    plugins: { js },
    extends: ["js/recommended"],
    languageOptions: { globals: globals.browser }
  },
  pluginVue.configs["flat/strongly-recommended"],
]);
