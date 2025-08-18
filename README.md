# Ababil Elementor Widgets

Ababil Elementor is a custom WordPress plugin that extends the Elementor page builder with a collection of unique, modern, and flexible widgets. It is designed to help you create beautiful, interactive, and professional websites with ease.

## Features

- **Multiple Custom Widgets:**  
  Includes widgets such as Styled Text, Content Box, ACF Repeater Accordion, and Breadcrumb for advanced layouts and dynamic content.
- **Separation of Resources:**  
  Each widget has its own CSS and JS for better performance and maintainability.
- **Modern Design:**  
  Clean, responsive, and customizable styles for all widgets.
- **Easy Integration:**  
  Seamlessly integrates with Elementor and WordPress.
- **Lightweight:**  
  Minimal code and optimized assets for fast performance.
- **ACF Integration:**  
  Use Advanced Custom Fields (ACF) repeater fields directly in your Elementor designs.

## Installation

1. Download or clone this repository to your local machine.
2. Copy the `AbabilElementorWidget` folder to your WordPress site's `wp-content/plugins/` directory.
3. In your WordPress admin dashboard, go to **Plugins** and activate **Ababil Elementor Widgets**.

## Usage

1. Make sure Elementor (and ACF for dynamic widgets) is installed and activated.
2. After activating this plugin, go to any page or post and edit with Elementor.
3. Find the new widgets (e.g., **Styled Text**, **Content Box**, **ACF Repeater Accordion**, **Breadcrumb**) in the Elementor panel under the "Ababil" section.
4. Drag and drop the widgets onto your page and customize as needed.

## File Structure

```
assets/
  css/
    styled-text.css           # CSS for Styled Text widget
    content-box.css           # CSS for Content Box widget
    acf-repeater-accordion.css# CSS for ACF Repeater Accordion widget
    breadcrumb.css            # CSS for Breadcrumb widget
  js/
    styled-text.js            # JS for Styled Text widget
    content-box.js            # JS for Content Box widget
    acf-repeater-accordion.js # JS for ACF Repeater Accordion widget
    breadcrumb.js             # JS for Breadcrumb widget
widgets/
  styled-text.php             # Styled Text widget PHP
  content-box.php             # Content Box widget PHP
  acf-repeater-accordion.php  # ACF Repeater Accordion widget PHP
  breadcrumb.php              # Breadcrumb widget PHP
ababil-elementor.php          # Main plugin file
```

## Customization

- **CSS:**  
  Edit the relevant file in `assets/css/` to change widget styles.
- **JavaScript:**  
  Edit the relevant file in `assets/js/` to add or modify widget interactivity.
- **Widgets:**  
  Add new PHP files in the `widgets/` directory to create more widgets.

## Example Widgets

- **Styled Text:**  
  Add visually appealing text segments with hover effects and advanced styling.
- **Content Box:**  
  Create flexible content boxes with icons, images, headings, badges, and buttons.
- **ACF Repeater Accordion:**  
  Display dynamic accordion content from ACF repeater fields, perfect for FAQs and more.
- **Breadcrumb:**  
  Add customizable breadcrumb navigation for better user experience.

## Contributing

Pull requests are welcome! For major changes, please open an issue first to discuss what you would like to change.

## License

This project is open source and available under the [MIT License](LICENSE).

---

**Ababil Elementor Widgets** — Make your Elementor pages stand out with custom widgets!