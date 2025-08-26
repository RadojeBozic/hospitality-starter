import React from 'react';
import { usePage } from '@inertiajs/react';

export default function LanguageSwitcher() {
  const { locale, locales } = usePage().props;
  const parts = window.location.pathname.split('/').filter(Boolean);
  const rest = parts.slice(1).join('/'); // sve posle prvog segmenta (locale)

  return (
    <div className="flex gap-3 text-sm">
      {Object.keys(locales).map((l) => (
        <a
          key={l}
          href={`/${l}/${rest}`}
          className={l === locale ? 'font-bold underline' : 'opacity-80 hover:opacity-100'}
        >
          {l}
        </a>
      ))}
    </div>
  );
}
