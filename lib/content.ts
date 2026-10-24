import type { CSSProperties } from 'react';
import defaults from '../data/content.json';

export type NavLink = { label: string; href: string };
export type Product = {
  name: string;
  tag: string;
  category: string;
  time: string;
  level: string;
  desc: string;
  image: string;
  color: string;
  price: string;
  link: string;
};
export type Article = { title: string; desc: string; image: string; tag: string; date: string };
export type FooterColumn = { title: string; links: NavLink[] };

export type SiteContent = {
  theme: {
    primaryColor: string;
    secondaryColor: string;
    accentColor: string;
    bgColor: string;
    textColor: string;
    navbarBg: string;
  };
  navbar: { brandName: string; brandSub: string; links: NavLink[] };
  hero: {
    title: string;
    description: string;
    badge: string;
    primaryBtnText: string;
    primaryBtnLink: string;
    secondaryBtnText: string;
    secondaryBtnLink: string;
    bgImage: string;
  };
  intro: { title: string; subtitle: string; items: { value: string; label: string }[] };
  products: Product[];
  articles: Article[];
  cta: { title: string; desc: string; btnText: string; btnLink: string };
  footer: {
    about: string;
    copyright: string;
    socialLinks: NavLink[];
    columns: FooterColumn[];
  };
};

export const defaultContent = defaults as unknown as SiteContent;

export function themeVars(theme: SiteContent['theme']): React.CSSProperties {
  return {
    '--primary': theme.primaryColor,
    '--secondary': theme.secondaryColor,
    '--accent': theme.accentColor,
    '--bg': theme.bgColor,
    '--text': theme.textColor,
    '--navbar-bg': theme.navbarBg,
    '--red': theme.primaryColor,
    '--sage': theme.secondaryColor,
    '--yellow': theme.accentColor,
    '--dark': theme.textColor,
  } as React.CSSProperties;
}
