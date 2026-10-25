import { NextResponse } from 'next/server';
import type { SiteContent } from '../../../lib/content';
import { getAdminPin, readContent, writeContent } from '../../../lib/store';

export const dynamic = 'force-dynamic';

export async function GET() {
  return NextResponse.json(await readContent());
}

export async function POST(req: Request) {
  if (req.headers.get('x-pin') !== (await getAdminPin())) {
    return NextResponse.json({ error: 'PIN salah' }, { status: 401 });
  }
  const body = (await req.json()) as SiteContent;
  if (!body || typeof body !== 'object' || !Array.isArray(body.products)) {
    return NextResponse.json({ error: 'Data tidak valid' }, { status: 400 });
  }
  await writeContent(body);
  return NextResponse.json({ ok: true });
}
