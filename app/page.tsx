import HomeClient from './home-client';
import { readContent } from '../lib/store';

export const dynamic = 'force-dynamic';

export default async function Home() {
  const content = await readContent();
  return <HomeClient content={content} />;
}
