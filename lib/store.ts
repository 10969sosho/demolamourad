import { promises as fs } from 'fs';
import path from 'path';
import { defaultContent, type SiteContent } from './content';

const CONTENT_FILE = path.join(process.cwd(), 'data', 'content.json');
export const ADMIN_PIN = process.env.ADMIN_PIN || '2468';

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
