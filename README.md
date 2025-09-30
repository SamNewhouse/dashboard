# Client Dashboard

A modern Vue 3 + Laravel dashboard for client management, analytics, and insights.

---

## Technologies Used

- Frontend: Vue 3 (Composition API, TypeScript, Vite)
- UI: Tailwind CSS, Heroicons
- Design System: Atomic Design (atoms, molecules, organisms, layouts)
- Routing: Vue Router (dynamic paging routes)
- API: Laravel (REST JSON), PHP 8+
- State/Data: Composition API refs/computeds

---

## Project Structure

src/  
 1-atoms/    # Smallest UI elements (Button.vue, Input.vue, Icon.vue, TableCell.vue)  
 2-molecules/  # Combo UI elements (TableRow.vue, CardStat.vue)  
 3-organisms/  # Functional modules (ClientTable.vue, SidebarMenu.vue)  
 4-layouts/   # Page layouts (DashboardLayout.vue)  
 pages/      # Top-level pages (Dashboard.vue, ClientsDashboard.vue)  
 router/     # Vue Router config  
api/        # Laravel controllers, models, migrations  
public/      # Static assets

Atomic Design: Reusable UI, combine atoms → molecules → organisms → layouts → pages.

---

## Routing

- Dashboard: `/dashboard`
- Clients List: `/dashboard/clients/page/:page/show/:perPage`
- Add Client: `/clients/new`

Dynamic route params for pagination; routes control fetch and reload.

---

## Core Processes

- **Data Fetching:** Loads paginated clients from `/api/clients?page=x&per_page=y`
- **Client Table:** Paginated, atomic TableRow/TableCell, router-driven controls
- **Analytics & KPIs:** Dashboard cards and charts, render only after API data loads
- **CRUD:** Add/Edit clients, validation handled in backend
- **Icons:** All heroicons via atomic Icon.vue, pass icon name and style

---

## Development Helper Commands

**Backend (Laravel)**

- `./vendor/bin/sail up -d`
- `./vendor/bin/sail down -v`
- `./vendor/bin/sail artisan migrate:fresh --seed`
- `./vendor/bin/sail npm run dev`

- `php artisan cache:clear`
- `php artisan cache:table`
- `php artisan config:clear`
- `php artisan route:clear`
- `php artisan route:list`
- `composer dump-autoload`

---

## References

- Atomic Design: https://bradfrost.com/blog/post/atomic-web-design/
- Vue 3 Docs: https://vuejs.org
- Laravel Docs: https://laravel.com/docs
- TailwindCSS: https://tailwindcss.com/docs
- Heroicons: https://heroicons.com

---

## Notes

- All new widgets/components: follow atomic folder structure.
- For new endpoints, update backend API controller.
- Run migrations and reseed as needed.
- Charts and icons are configured via props.

---

Happy Building!
