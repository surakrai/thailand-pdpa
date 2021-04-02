import './admin.scss'

import toplevelPageTpdpaSettingAdmin from './admin/js/common'

import Router from './util/Router'
/**
 * Populate Router instance with DOM routes
 * @type {Router} routes - An instance of our router
 */

const routes = new Router({ toplevelPageTpdpaSettingAdmin })

window.addEventListener('DOMContentLoaded', () => {
  routes.loadEvents()
})
