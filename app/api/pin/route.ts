import { NextResponse } from 'next/server';
import { getAdminPin, setAdminPin } from '../../../lib/store';

export const dynamic = 'force-dynamic';

export async function POST(req: Request) {
  const current = req.headers.get('x-pin') ?? '';
  if (current !== (await getAdminPin())) {
    return NextResponse.json({ error: 'PIN salah' }, { status: 401 });
  }
  const { next } = (await req.json().catch(() => ({}))) as { next?: string };
  if (!next) return NextResponse.json({ ok: true });
  const value = String(next).trim();
  if (value.length < 4) {
    return NextResponse.json({ error: 'PIN minimal 4 digit' }, { status: 400 });
  }
  await setAdminPin(value);
  return NextResponse.json({ ok: true });
}
