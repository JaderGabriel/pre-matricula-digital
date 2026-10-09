export async function localizarEndereco(endereco: string): Promise<{
  lat: number;
  lng: number;
  endereco: string;
} | null> {
  try {
    const destino = new URL('/pre-matricula-localizar', window.location.origin);
    destino.searchParams.set('endereco', endereco);
    const resposta = await fetch(destino.toString(), {
      headers: cabecalhosPublicos(),
      credentials: 'same-origin',
    });
    if (!resposta.ok || !resposta.headers.get('content-type')?.includes('json')) {
      return null;
    }
    const dados = await resposta.json();

    if (!dados?.encontrado || dados.latitude == null || dados.longitude == null) {
      return null;
    }

    return {
      lat: Number(dados.latitude),
      lng: Number(dados.longitude),
      endereco: String(dados.endereco || ''),
    };
  } catch {
    return null;
  }
}

export function cabecalhosPublicos(): HeadersInit {
  return {
    Accept: 'application/json',
    Authorization: `Bearer ${window.config?.token || ''}`,
    'X-Requested-With': 'XMLHttpRequest',
  };
}
