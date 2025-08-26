import i18n from 'i18next';
import { initReactI18next } from 'react-i18next';

const resources = {
  'sr-Latn-RS': { translation: { 'home.title': 'Početna', 'order': 'Naruči' } },
  'sr-Cyrl-RS': { translation: { 'home.title': 'Почетна', 'order': 'Наручи' } },
  en:           { translation: { 'home.title': 'Home',    'order': 'Order'  } },
};

export function initI18n(currentLocale) {
  i18n.use(initReactI18next).init({
    resources,
    lng: currentLocale,
    fallbackLng: 'en',
    interpolation: { escapeValue: false },
  });
}
