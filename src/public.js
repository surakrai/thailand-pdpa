import './public.scss'

import common from './public/js/common'

import Router from './util/Router'
/**
 * Populate Router instance with DOM routes
 * @type {Router} routes - An instance of our router
 */

const routes = new Router({ common })

window.addEventListener('DOMContentLoaded', () => {
  routes.loadEvents()
})
