import VueCookies from 'vue-cookies'

export const saveToken = (token) => {
  // Guardar el token de sesión en una cookie con una duración de 1 hora
  VueCookies.set('session_token', token, '1h')
}

export const getToken = () => {
  return VueCookies.get('session_token')
}
export const deleteToken = () => {
  VueCookies.remove('session_token')
}
