import React from 'react';
import { Head, Link, usePage } from '@inertiajs/react';
import LanguageSwitcher from '@/Components/LanguageSwitcher';

export default function PageView({ title, body, slug }) {
  const { locale } = usePage().props;
  return (
    <div className="min-h-screen">
      <Head title={title} />
      <div className="p-4 flex justify-end sticky top-0 z-50 bg-white/60 backdrop-blur">
        <LanguageSwitcher />
      </div>
      <main className="max-w-3xl mx-auto p-6">
        <h1 className="text-3xl font-bold mb-4">{title}</h1>
        <div className="prose max-w-none" dangerouslySetInnerHTML={{ __html: body }} />
        <div className="mt-8 text-sm text-gray-500">/ {locale} / {slug}</div>
        <div className="mt-6">
          <Link href={`/${locale}/`} className="underline">← Nazad na početnu</Link>
        </div>
      </main>
    </div>
  );
}
