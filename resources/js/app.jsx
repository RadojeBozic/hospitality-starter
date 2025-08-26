import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/react';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createRoot } from 'react-dom/client';
import { initI18n } from './i18n';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
     resolve: name => {
    const pages = import.meta.glob(['./Pages/**/*.jsx', './Pages/**/*.tsx'], { eager: true });
    return pages[`./Pages/${name}.jsx`] ?? pages[`./Pages/${name}.tsx`];
  },
    setup({ el, App, props }) {
        const root = createRoot(el);
        initI18n(props.initialPage.props.locale);

        root.render(<App {...props} />);
    },
    progress: {
        color: '#4B5563',
    },
});
