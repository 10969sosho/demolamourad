import { promises as fs } from 'fs';
import path from 'path';
import { defaultContent, type SiteContent } from './content';

const CONTENT_FILE = path.join(process.cwd(), 'data', 'content.json');
const PIN_FILE = path.join(process.cwd(), 'data', '.admin-pin');
const FALLBACK_PIN = process.env.ADMIN_PIN || '2468';

export async function getAdminPin(): Promise<string> {
  try {
    const v = (await fs.readFile(PIN_FILE, 'utf8')).trim();
    return v || FALLBACK_PIN;
  } catch {
    return FALLBACK_PIN;
  }
}

export async function setAdminPin(pin: string) {
  await fs.writeFile(PIN_FILE, pin, 'utf8');
}

export async function readContent(): Promise<SiteContent> {
  try {
    return JSON.parse(await fs.readFile(CONTENT_FILE, 'utf8')) as SiteContent;
  } catch {
    return defaultContent;
  }
}

export async function writeContent(content: SiteContent) {
  await fs.writeFile(CONTENT_FILE, JSON.stringify(content, null, 2), 'utf8');
}
