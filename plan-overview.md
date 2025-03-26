# VS Forms: Implementation Plan Overview

## Project Overview

This document outlines the comprehensive plan to refactor OpnForm into VS Forms, a specialized form solution for USA-based travel agent advisors. This overview is structured to provide clear guidance for implementation tasks with specific file paths and detailed steps.

## Project Goals

1. **Rebrand OpnForm** as "VS Forms by Voyager Social AI"
2. **Implement a new visual identity** using the crimson theme
3. **Create travel-specific templates** for travel advisors
4. **Update all content** to target travel industry professionals
5. **Configure the system** for self-hosting

## Target Audience Definition

**Primary Users**: USA-based travel agent advisors
- Owner-operators
- Small to medium travel agencies
- Independent travel consultants

**User Needs**:
- Client onboarding forms
- Travel preference questionnaires
- Trip planning forms
- Feedback collection
- Travel itinerary confirmations

## Branding Decisions

### Visual Identity
- **Name**: VS Forms (by Voyager Social AI)
- **Theme**: Crimson theme
- **Primary Color**: Crimson red (`oklch(55.66% 0.21 19.69deg)`)
- **Secondary Color**: Steel blue (`oklch(59.25% 0.09 239.65deg)`)
- **Typography**: Avenir/Montserrat font family

### Brand Voice
- Professional but approachable
- Travel industry-specific terminology
- Focus on efficiency and client service
- Emphasize security and reliability for handling client data

## Current Implementation Status

### Completed Tasks
1. Created comprehensive refactoring plan
2. Updated API environment variables:
   - Changed APP_NAME to "VS Forms"
   - Set MAIL_FROM_ADDRESS to "notifications@voyagersocial.ai"
   - Set MAIL_FROM_NAME to "VS Forms by Voyager Social AI"
   - Updated admin emails to Voyager Social email addresses

### In Progress
None currently active

## Implementation Tasks

### 1. Theme Implementation

#### 1.1 Create VS Forms Theme
- **File Path**: `client/scss/themes/_vs-forms.scss`
- **Task**: Create new theme file with crimson color scheme
- **Code Snippet**:
```scss
[data-theme='vs-forms'] {
  --text-scaling: 1.067;
  --base-font-color: var(--color-surface-950);
  --base-font-color-dark: var(--color-surface-50);
  --base-font-family: Avenir, Montserrat, Corbel, 'URW Gothic', source-sans-pro, sans-serif;
  /* Copy all variables from crimson theme */
  /* Primary: Crimson red */
  --color-primary-50: oklch(88.77% 0.05 4.09deg);
  --color-primary-100: oklch(80.79% 0.08 6.87deg);
  /* ... include all color values ... */
  --color-primary-500: oklch(55.66% 0.21 19.69deg);
  /* ... */
}
```

#### 1.2 Register Theme in Theme System
- **File Path**: Look for theme registration file in `client/components/ui/` or similar
- **Task**: Add VS Forms theme to available themes

#### 1.3 Update Tailwind Configuration
- **File Path**: `client/tailwind.config.js`
- **Task**: Update color configuration for Tailwind

### 2. Configuration Updates

#### 2.1 Update Nuxt Configuration
- **File Path**: `client/nuxt.config.ts`
- **Task**: Update app name, description, and metadata

#### 2.2 Update OpnForm Configuration
- **File Path**: `client/opnform.config.js`
- **Task**: Change name, company, and default theme
- **Code Snippet**:
```javascript
export default {
  name: 'VS Forms',
  company: 'Voyager Social AI',
  brandingText: 'VS Forms by Voyager Social AI',
  defaultTheme: 'vs-forms',
  supportEmail: 'support@voyagersocial.ai',
  // ... other settings ...
}
```

### 3. Asset Replacement

#### 3.1 Logo Replacement
- **Task**: Create new VS Forms logo
- **File Paths**:
  - `client/public/img/logo.svg`
  - `client/public/img/logo-dark.svg` (if exists)
  - `client/public/img/logo-icon.svg` (if exists)

#### 3.2 Favicon Replacement
- **File Path**: `client/public/favicon.ico`
- **Task**: Create new favicon based on VS Forms branding

#### 3.3 Social Preview Images
- **File Path**: `client/public/img/social-preview.jpg`
- **Task**: Create new social preview image for VS Forms

### 4. Content Updates

#### 4.1 Landing Page Update
- **File Path**: `client/pages/index.vue`
- **Task**: Update copy to target travel advisors

#### 4.2 Marketing Content
- **File Paths**: Search for marketing content in `client/components/` and `client/pages/`
- **Task**: Update all marketing content to target travel industry

#### 4.3 Email Templates
- **File Paths**: Check `api/resources/views/emails/`
- **Task**: Update email templates with VS Forms branding and travel-specific language

### 5. Travel-Specific Templates

#### 5.1 Create Template Seeder
- **File Path**: `api/database/seeders/TravelTemplateSeeder.php`
- **Task**: Create seeder for travel form templates
- **Template Types**:
  - Client Travel Preferences
  - Trip Planning Form
  - Travel Feedback Form
  - Client Onboarding

#### 5.2 Register Seeder
- **File Path**: `api/database/seeders/DatabaseSeeder.php`
- **Task**: Add TravelTemplateSeeder to seeder list

#### 5.3 Create Sample Templates
Design each template with fields relevant to travel advisors:
- Client contact information
- Travel preferences (destinations, accommodation types)
- Budget ranges
- Trip durations
- Special requirements

### 6. System-Wide Rebranding

#### 6.1 Find and Replace
- **Task**: Find all instances of "OpnForm" in the codebase and replace with "VS Forms"
- **Command**: `grep -r "OpnForm" --include="*.vue" --include="*.js" --include="*.php" .`

#### 6.2 Update Component Text
- **Task**: Scan UI components for hardcoded "OpnForm" text
- **File Paths**: Check components in `client/components/`

#### 6.3 Error Pages
- **File Path**: `client/error.vue`
- **Task**: Update error pages with VS Forms branding

### 7. Testing Plan

#### 7.1 Visual Testing
- **Task**: Test theme appearance across all pages
- **Check Points**:
  - Color scheme consistency
  - Logo appearance
  - Typography rendering

#### 7.2 Functional Testing
- **Task**: Test all form functionality with new themes
- **Check Points**:
  - Form creation
  - Form submission
  - Notifications

#### 7.3 Template Testing
- **Task**: Test travel-specific templates
- **Check Points**:
  - Template rendering
  - Form field functionality
  - Mobile responsiveness

## Implementation Guidelines

### Coding Standards
- Maintain existing code style and conventions
- Document changes with comments where appropriate
- Test changes in development environment before committing

### Prioritization
Implement tasks in this order:
1. Theme implementation
2. Configuration updates
3. Asset replacement
4. Travel template creation
5. Content updates
6. System-wide rebranding
7. Testing

### Success Criteria
- VS Forms branding appears consistently throughout the application
- Crimson theme is properly implemented and visually appealing
- Travel-specific templates are available and functional
- All "OpnForm" references are replaced with "VS Forms"
- Application functionality remains intact

## Future Enhancements

After initial implementation, consider these enhancements:
- Travel-specific form components (destination pickers, etc.)
- Integration with travel booking systems
- Travel itinerary PDF generation
- Client management features for travel advisors

---

**Created by**: Voyager Social AI
**Date**: [Current Date]
**Version**: 1.0 
