<?php

namespace UCSS\App;

use UCSS\Auth;

/**
 * This class handles adding the UCSS plugin's admin menu
 * and injecting JavaScript and CSS required for the admin page. 
 * It also renders the display content for the UCSS plugin. 
 *
 * @package UCSS
 */
class Menu {
    
    /**
     * @var string Base64-encoded SVG icon used for the admin menu icon.
     */
    public static $menu_icon = 'data:image/svg+xml;base64,PHN2ZyBjbGFzcz0iZmxleC1zaHJpbmstMCB3LTUgaC01IGlubGluZS1ibG9jayBtdC1bLTNweF0iIAogICAgICAgICAgICAgICAgICB2aWV3Qm94PSItMzEuODcyIC0zLjg0MiA2NC4yMDMgMjYuMzA0IiB4bWw6c3BhY2U9InByZXNlcnZlIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj4KICAgICAgICAgICAgICAgICAgPGcgZmlsbD0iI2E3YWFhZCIgc3Ryb2tlPSIjYTdhYWFkIiBzdHJva2UtbWl0ZXJsaW1pdD0iMTAiIHN0cm9rZS13aWR0aD0iMiI+CiAgICAgICAgICAgICAgICAgICAgPHBhdGggZD0ibS0yOS43MDQgOS4xNzJjMC0yLjY4OCAwLjgzOS00LjkzMiAyLjUxNS02LjczOSAxLjY3OC0xLjgwNSAzLjUyLTMuMDExIDUuNTMzLTMuNjEyIDAuNDYyLTAuMTYxIDAuOTI2LTAuMjc3IDEuMzg5LTAuMzQ4IDAuNDYtMC4wNzEgMC45MTItMC4xMDQgMS4zNTItMC4xMDRsMjQuNTYxLTAuMDM0djIuNzA0aC0yMy44MzRjLTIuNzk3IDAuMjc3LTQuOTI1IDEuMjUxLTYuMzgyIDIuOTE0LTEuNDU3IDEuNjY0LTIuMTk5IDMuNDY5LTIuMjIyIDUuNDEydjAuMTAyYzAgMC40NDEgMC4wNiAwLjk3MiAwLjE3NiAxLjU5OHMwLjMyMSAxLjI1OSAwLjYyNSAxLjkwOGMwLjUwNyAxLjE1OCAxLjM2OCAyLjIyIDIuNTgyIDMuMTc5IDEuMjE4IDAuOTYgMi45NTcgMS40MzMgNS4yMjMgMS40MzNoMi40NjJ2Mi42MzloLTMuOTE4Yy0zLjIxNS0wLjA5My01LjY5Ni0xLjE4LTcuNDQxLTMuMjY1LTEuNzQ4LTIuMDgyLTIuNjItNC42NjgtMi42Mi03Ljc1di0wLjAzN3oiLz4KICAgICAgICAgICAgICAgICAgICA8cGF0aCBkPSJtLTYuNDYgMTcuNTUxYzAuOTcgMC4wMjMgMS43NS0wLjE1OSAyLjMzOS0wLjU1MyAwLjU5LTAuMzk2IDAuOTQzLTEuMDE4IDEuMDU4LTEuODc1IDAtMC43NC0wLjI0My0xLjQyMi0wLjcyOC0yLjA0NS0wLjQ4Ni0wLjYyNi0xLjIxNC0xLjE4NC0yLjE4Ni0xLjY3LTAuMTg2LTAuMDkxLTAuMzc4LTAuMTgxLTAuNTczLTAuMjcxLTAuMTk4LTAuMDk2LTAuMzk3LTAuMTkzLTAuNjA3LTAuMjgzLTAuMDIyLTAuMDIyLTAuMDU0LTAuMDM5LTAuMDg4LTAuMDUtMC4wMzMtMC4wMTItMC4wNjUtMC4wMjgtMC4wODctMC4wNTEtMS43MTEtMC44MzUtMy4yNzctMS43MjgtNC43LTIuNjg4LTEuNDItMC45NTgtMi4xMzItMi4yNjktMi4xMzItMy45MzcgMC4wMjMtMC4wNyAwLjAzNS0wLjEyNyAwLjAzNS0wLjE3NSAwLTAuMDQ1IDVlLTMgLTAuMDc5IDAuMDE2LTAuMTA0IDAuMDEyLTAuMDIzIDAuMDE4LTAuMDQ2IDAuMDE4LTAuMDY5IDAtMS42MDUgMC40NTgtMi44MTYgMS4zNzMtMy42MyAwLjkxMS0wLjgxNiAxLjkxMS0xLjM0OSAyLjk5Ny0xLjYwNiAwLjE2NS0wLjA0NyAwLjMzMS0wLjA4MiAwLjUwNS0wLjEwNCAwLjE3My0wLjAyNiAwLjMzOS0wLjA0OCAwLjUwMy0wLjA3MWw3LjYzLTAuMDM0djIuNzA0aC03LjE0NWMtMC44MTEgMC4wMjMtMS40NTcgMC4yNzUtMS45NDEgMC43NDYtMC40ODYgMC40NzQtMC43ODggMS4wMDItMC45MDQgMS41NzggMCAwLjA5My02ZS0zIDAuMTgxLTAuMDE3IDAuMjYyLTAuMDEyIDAuMDgtMC4wMTcgMC4xNTUtMC4wMTcgMC4yMjQgMCAwLjMyNSAwLjA4MiAwLjY0MiAwLjI0MiAwLjk1NCAwLjE2MSAwLjMxMyAwLjM4MSAwLjU2NCAwLjY1OCAwLjc0NSAwLjk0OSAwLjY3MiAxLjg0IDEuMjE5IDIuNjcyIDEuNjMyIDAuODMzIDAuNDE3IDEuNjA3IDAuNzk1IDIuMzI0IDEuMTQ1IDAuMjA5IDAuMTEyIDAuNDA5IDAuMjI2IDAuNjA3IDAuMzI4IDAuMTk0IDAuMTAyIDAuMzg2IDAuMjEzIDAuNTczIDAuMzI3IDAuMTYxIDAuMDk2IDAuMzI4IDAuMTkzIDAuNTAzIDAuMzAxIDAuMTcyIDAuMTAyIDAuMzQxIDAuMjA5IDAuNTAxIDAuMzI3IDAuNzE4IDAuNTM2IDEuMzgxIDEuMjAzIDEuOTk3IDIuMDE2IDAuNjEyIDAuODA3IDAuOTE3IDEuODEyIDAuOTE3IDMuMDE1IDAgMC4zMDUtMC4wMTcgMC42MzItMC4wNSAxLjAwNC0wLjAzNSAwLjM3My0wLjExMSAwLjc0NS0wLjIyNiAxLjExMy0wLjI1MyAwLjg5Ni0wLjc4MSAxLjcxNC0xLjU3NyAyLjQ0NC0wLjc5OSAwLjcyNi0yLjA1MyAwLjgxMS0zLjc2NCAwLjgxMWgtMC4xMDQtMC4xMDQtMC4wMzRjLTAuMDQ4IDAtMC4wOTMtMC4wMTEtMC4xNDEtMC4wMjItMC4wNDUtMC4wMTItMC4wNzktMC4wMTItMC4xMDMtMC4wMTJsLTguMTE4LTAuMDM4di0yLjM4OGg3Ljg3OHoiLz4KICAgICAgICAgICAgICAgICAgICA8cGF0aCBkPSJtOS42MzQgMTcuNTUxYzAuOTcxIDAuMDIzIDEuNzUxLTAuMTU5IDIuMzM3LTAuNTUzIDAuNTk0LTAuMzk2IDAuOTQ4LTEuMDE4IDEuMDYyLTEuODc1IDAtMC43NC0wLjI0My0xLjQyMi0wLjcyOS0yLjA0NS0wLjQ4NC0wLjYyNi0xLjIxMy0xLjE4NC0yLjE4NS0xLjY3LTAuMTg0LTAuMDkxLTAuMzc3LTAuMTgxLTAuNTcxLTAuMjcxLTAuMTk5LTAuMDk2LTAuMzk4LTAuMTkzLTAuNjA3LTAuMjgzLTAuMDIzLTAuMDIyLTAuMDU1LTAuMDM5LTAuMDg3LTAuMDUtMC4wMzUtMC4wMTItMC4wNjYtMC4wMjgtMC4wODgtMC4wNTEtMS43MTEtMC44MzUtMy4yNzctMS43MjgtNC43MDEtMi42ODgtMS40MTktMC45NTktMi4xMzEtMi4yNjktMi4xMzEtMy45MzcgMC4wMjItMC4wNyAwLjAzNC0wLjEyOCAwLjAzNC0wLjE3NSAwLTAuMDQ1IDZlLTMgLTAuMDc5IDAuMDE3LTAuMTA0IDAuMDEyLTAuMDIzIDAuMDE3LTAuMDQ2IDAuMDE3LTAuMDY5IDAtMS42MDUgMC40NTgtMi44MTYgMS4zNzEtMy42MyAwLjkxMi0wLjgxNiAxLjkxMS0xLjM0OSAyLjk5OS0xLjYwNiAwLjE2Mi0wLjA0OCAwLjMzLTAuMDgzIDAuNTA1LTAuMTA0IDAuMTcyLTAuMDI2IDAuMzM3LTAuMDQ4IDAuNS0wLjA3MWw3LjYzMS0wLjAzNHYyLjcwNGgtNy4xNDRjLTAuODEgMC4wMjMtMS40NTcgMC4yNzUtMS45NDIgMC43NDYtMC40ODQgMC40NzQtMC43ODYgMS4wMDItMC45MDMgMS41NzggMCAwLjA5My02ZS0zIDAuMTgxLTAuMDE2IDAuMjYyLTAuMDEyIDAuMDgtMC4wMTggMC4xNTUtMC4wMTggMC4yMjQgMCAwLjMyNSAwLjA4MyAwLjY0MiAwLjI0MyAwLjk1NCAwLjE2IDAuMzEzIDAuMzgxIDAuNTY0IDAuNjU4IDAuNzQ1IDAuOTQ5IDAuNjcyIDEuODQgMS4yMTkgMi42NzQgMS42MzIgMC44MzIgMC40MTcgMS42MDYgMC43OTUgMi4zMjIgMS4xNDUgMC4yMDkgMC4xMTIgMC40MTIgMC4yMjYgMC42MDUgMC4zMjggMC4xOTcgMC4xMDIgMC4zODkgMC4yMTMgMC41NzYgMC4zMjcgMC4xNTggMC4wOTYgMC4zMjcgMC4xOTMgMC41MDIgMC4zMDEgMC4xNzQgMC4xMDIgMC4zNDMgMC4yMDkgMC41MDIgMC4zMjcgMC43MTcgMC41MzYgMS4zNzcgMS4yMDMgMiAyLjAxNiAwLjYwNyAwLjgwNyAwLjkxNCAxLjgxMiAwLjkxNCAzLjAxNSAwIDAuMzA1LTAuMDE4IDAuNjMyLTAuMDUyIDEuMDA0LTAuMDMzIDAuMzczLTAuMTA3IDAuNzQ1LTAuMjI1IDEuMTEzLTAuMjU1IDAuODk3LTAuNzg1IDEuNzE1LTEuNTc2IDIuNDQ1LTAuODAzIDAuNzI2LTIuMDU0IDAuODExLTMuNzY2IDAuODExaC0wLjEwNy0wLjEwMi0wLjAzNWMtMC4wNDQgMC0wLjA4OC0wLjAxMS0wLjE0LTAuMDIyLTAuMDQ0LTAuMDEyLTAuMDc4LTAuMDEyLTAuMTAyLTAuMDEybC04LjExOS0wLjAzOHYtMi4zODhoNy44Nzd6Ii8+CiAgICAgICAgICAgICAgICAgICAgPHBhdGggZD0ibTMwLjE1OSA5LjIwOGMwIDMuMDgzLTAuODcgNS42NjktMi42MiA3Ljc0OS0xLjc0MyAyLjA4NC00LjIyNSAzLjE3LTcuNDQxIDMuMjY0aC0zMy44NHYtMi42MzloMzIuMzg0YzIuMjY0IDAgNC4wMDQtMC40NzMgNS4yMjItMS40MzIgMS4yMTQtMC45NTcgMi4wNzgtMi4wMiAyLjU4Ni0zLjE3NCAwLjI5OS0wLjY1MSAwLjUwNy0xLjI4NiAwLjYyMi0xLjkxMiAwLjExOS0wLjYyNiAwLjE3NC0xLjE1NiAwLjE3NC0xLjU5OHYtMC4xMDJjLTAuMDIzLTEuOTQzLTAuNzYyLTMuNzQ4LTIuMjE4LTUuNDEyLTEuNDU4LTEuNjYzLTMuNTkyLTIuNjM3LTYuMzg2LTIuOTE0aC0xMS4wMTJ2LTIuNzA0bDExLjMxMyAwLjAzNGMwLjQ0MSAwIDEuMzE5IDAuMDMzIDEuNzc3IDAuMTA0IDAuNDYyIDAuMDcxIDAuOTI2IDAuMTg3IDEuMzg5IDAuMzQ4IDIuMDEzIDAuNjAxIDMuODYxIDEuODA3IDUuNTM4IDMuNjEyIDEuNjc2IDEuODA3IDIuNTEzIDQuMDUxIDIuNTEzIDYuNzM5djAuMDM3eiIvPgogICAgICAgICAgICAgICAgICA8L2c+CiAgICAgICAgICAgICAgPC9zdmc+';

    /**
     * @var string Base64-encoded SVG icon used for the admin menu icon when we are on the UCSS page
     */
    public static $menu_icon_selected = 'data:image/svg+xml;base64,PHN2ZyBjbGFzcz0iZmxleC1zaHJpbmstMCB3LTUgaC01IGlubGluZS1ibG9jayBtdC1bLTNweF0iIA0KICAgIHZpZXdCb3g9Ii0zMS44NzIgLTMuODQyIDY0LjIwMyAyNi4zMDQiIHhtbDpzcGFjZT0icHJlc2VydmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPg0KICAgIDxkZWZzPg0KICAgICAgICA8bGluZWFyR3JhZGllbnQgaWQ9ImdyYWRpZW50MSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIxMDAlIiB5Mj0iMCUiPg0KICAgICAgICAgICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3R5bGU9InN0b3AtY29sb3I6IzA2YjZkNDtzdG9wLW9wYWNpdHk6MSIgLz4NCiAgICAgICAgICAgIDxzdG9wIG9mZnNldD0iMTAwJSIgc3R5bGU9InN0b3AtY29sb3I6IzNmODNmODtzdG9wLW9wYWNpdHk6MSIgLz4NCiAgICAgICAgPC9saW5lYXJHcmFkaWVudD4NCiAgICA8L2RlZnM+DQogICAgPGcgZmlsbD0idXJsKCNncmFkaWVudDEpIiBzdHJva2U9InVybCgjZ3JhZGllbnQxKSIgc3Ryb2tlLW1pdGVybGltaXQ9IjEwIiBzdHJva2Utd2lkdGg9IjIiPg0KICAgICAgICA8cGF0aCBkPSJtLTI5LjcwNCA5LjE3MmMwLTIuNjg4IDAuODM5LTQuOTMyIDIuNTE1LTYuNzM5IDEuNjc4LTEuODA1IDMuNTItMy4wMTEgNS41MzMtMy42MTIgMC40NjItMC4xNjEgMC45MjYtMC4yNzcgMS4zODktMC4zNDggMC40Ni0wLjA3MSAwLjkxMi0wLjEwNCAxLjM1Mi0wLjEwNGwyNC41NjEtMC4wMzR2Mi43MDRoLTIzLjgzNGMtMi43OTcgMC4yNzctNC45MjUgMS4yNTEtNi4zODIgMi45MTQtMS40NTcgMS42NjQtMi4xOTkgMy40NjktMi4yMjIgNS40MTJ2MC4xMDJjMCAwLjQ0MSAwLjA2IDAuOTcyIDAuMTc2IDEuNTk4czAuMzIxIDEuMjU5IDAuNjI1IDEuOTA4YzAuNTA3IDEuMTU4IDEuMzY4IDIuMjIgMi41ODIgMy4xNzkgMS4yMTggMC45NiAyLjk1NyAxLjQzMyA1LjIyMyAxLjQzM2gyLjQ2MnYyLjYzOWgtMy45MThjLTMuMjE1LTAuMDkzLTUuNjk2LTEuMTgtNy40NDEtMy4yNjUtMS43NDgtMi4wODItMi42Mi00LjY2OC0yLjYyLTcuNzV2LTAuMDM3eiIvPg0KICAgICAgICA8cGF0aCBkPSJtLTYuNDYgMTcuNTUxYzAuOTcgMC4wMjMgMS43NS0wLjE1OSAyLjMzOS0wLjU1MyAwLjU5LTAuMzk2IDAuOTQzLTEuMDE4IDEuMDU4LTEuODc1IDAtMC43NC0wLjI0My0xLjQyMi0wLjcyOC0yLjA0NS0wLjQ4Ni0wLjYyNi0xLjIxNC0xLjE4NC0yLjE4Ni0xLjY3LTAuMTg2LTAuMDkxLTAuMzc4LTAuMTgxLTAuNTczLTAuMjcxLTAuMTk4LTAuMDk2LTAuMzk3LTAuMTkzLTAuNjA3LTAuMjgzLTAuMDIyLTAuMDIyLTAuMDU0LTAuMDM5LTAuMDg4LTAuMDUtMC4wMzMtMC4wMTItMC4wNjUtMC4wMjgtMC4wODctMC4wNTEtMS43MTEtMC44MzUtMy4yNzctMS43MjgtNC43LTIuNjg4LTEuNDItMC45NTgtMi4xMzItMi4yNjktMi4xMzItMy45MzcgMC4wMjMtMC4wNyAwLjAzNS0wLjEyNyAwLjAzNS0wLjE3NSAwLTAuMDQ1IDVlLTMgLTAuMDc5IDAuMDE2LTAuMTA0IDAuMDEyLTAuMDIzIDAuMDE4LTAuMDQ2IDAuMDE4LTAuMDY5IDAtMS42MDUgMC40NTgtMi44MTYgMS4zNzMtMy42MyAwLjkxMS0wLjgxNiAxLjkxMS0xLjM0OSAyLjk5Ny0xLjYwNiAwLjE2NS0wLjA0NyAwLjMzMS0wLjA4MiAwLjUwNS0wLjEwNCAwLjE3My0wLjAyNiAwLjMzOS0wLjA0OCAwLjUwMy0wLjA3MWw3LjYzLTAuMDM0djIuNzA0aC03LjE0NWMtMC44MTEgMC4wMjMtMS40NTcgMC4yNzUtMS45NDEgMC43NDYtMC40ODYgMC40NzQtMC43ODggMS4wMDItMC45MDQgMS41NzggMCAwLjA5My02ZS0zIDAuMTgxLTAuMDE3IDAuMjYyLTAuMDEyIDAuMDgtMC4wMTcgMC4xNTUtMC4wMTcgMC4yMjQgMCAwLjMyNSAwLjA4MiAwLjY0MiAwLjI0MiAwLjk1NCAwLjE2MSAwLjMxMyAwLjM4MSAwLjU2NCAwLjY1OCAwLjc0NSAwLjk0OSAwLjY3MiAxLjg0IDEuMjE5IDIuNjcyIDEuNjMyIDAuODMzIDAuNDE3IDEuNjA3IDAuNzk1IDIuMzI0IDEuMTQ1IDAuMjA5IDAuMTEyIDAuNDA5IDAuMjI2IDAuNjA3IDAuMzI4IDAuMTk0IDAuMTAyIDAuMzg2IDAuMjEzIDAuNTczIDAuMzI3IDAuMTYxIDAuMDk2IDAuMzI4IDAuMTkzIDAuNTAzIDAuMzAxIDAuMTcyIDAuMTAyIDAuMzQxIDAuMjA5IDAuNTAxIDAuMzI3IDAuNzE4IDAuNTM2IDEuMzgxIDEuMjAzIDEuOTk3IDIuMDE2IDAuNjEyIDAuODA3IDAuOTE3IDEuODEyIDAuOTE3IDMuMDE1IDAgMC4zMDUtMC4wMTcgMC42MzItMC4wNSAxLjAwNC0wLjAzNSAwLjM3My0wLjExMSAwLjc0NS0wLjIyNiAxLjExMy0wLjI1MyAwLjg5Ni0wLjc4MSAxLjcxNC0xLjU3NyAyLjQ0NC0wLjc5OSAwLjcyNi0yLjA1MyAwLjgxMS0zLjc2NCAwLjgxMWgtMC4xMDQtMC4xMDQtMC4wMzRjLTAuMDQ4IDAtMC4wOTMtMC4wMTEtMC4xNDEtMC4wMjItMC4wNDUtMC4wMTItMC4wNzktMC4wMTItMC4xMDMtMC4wMTJsLTguMTE4LTAuMDM4di0yLjM4OGg3Ljg3OHoiLz4NCiAgICAgICAgPHBhdGggZD0ibTkuNjM0IDE3LjU1MWMwLjk3MSAwLjAyMyAxLjc1MS0wLjE1OSAyLjMzNy0wLjU1MyAwLjU5NC0wLjM5NiAwLjk0OC0xLjAxOCAxLjA2Mi0xLjg3NSAwLTAuNzQtMC4yNDMtMS40MjItMC43MjktMi4wNDUtMC40ODQtMC42MjYtMS4yMTMtMS4xODQtMi4xODUtMS42Ny0wLjE4NC0wLjA5MS0wLjM3Ny0wLjE4MS0wLjU3MS0wLjI3MS0wLjE5OS0wLjA5Ni0wLjM5OC0wLjE5My0wLjYwNy0wLjI4My0wLjAyMy0wLjAyMi0wLjA1NS0wLjAzOS0wLjA4Ny0wLjA1LTAuMDM1LTAuMDEyLTAuMDY2LTAuMDI4LTAuMDg4LTAuMDUxLTEuNzExLTAuODM1LTMuMjc3LTEuNzI4LTQuNzAxLTIuNjg4LTEuNDE5LTAuOTU5LTIuMTMxLTIuMjY5LTIuMTMxLTMuOTM3IDAuMDIyLTAuMDcgMC4wMzQtMC4xMjggMC4wMzQtMC4xNzUgMC0wLjA0NSA2ZS0zIC0wLjA3OSAwLjAxNy0wLjEwNCAwLjAxMi0wLjAyMyAwLjAxNy0wLjA0NiAwLjAxNy0wLjA2OSAwLTEuNjA1IDAuNDU4LTIuODE2IDEuMzcxLTMuNjMgMC45MTItMC44MTYgMS45MTEtMS4zNDkgMi45OTktMS42MDYgMC4xNjItMC4wNDggMC4zMy0wLjA4MyAwLjUwNS0wLjEwNCAwLjE3Mi0wLjAyNiAwLjMzNy0wLjA0OCAwLjUtMC4wNzFsNy42MzEtMC4wMzR2Mi43MDRoLTcuMTQ0Yy0wLjgxIDAuMDIzLTEuNDU3IDAuMjc1LTEuOTQyIDAuNzQ2LTAuNDg0IDAuNDc0LTAuNzg2IDEuMDAyLTAuOTAzIDEuNTc4IDAgMC4wOTMtNmUtMyAwLjE4MS0wLjAxNiAwLjI2Mi0wLjAxMiAwLjA4LTAuMDE4IDAuMTU1LTAuMDE4IDAuMjI0IDAgMC4zMjUgMC4wODMgMC42NDIgMC4yNDMgMC45NTQgMC4xNiAwLjMxMyAwLjM4MSAwLjU2NCAwLjY1OCAwLjc0NSAwLjk0OSAwLjY3MiAxLjg0IDEuMjE5IDIuNjc0IDEuNjMyIDAuODMyIDAuNDE3IDEuNjA2IDAuNzk1IDIuMzIyIDEuMTQ1IDAuMjA5IDAuMTEyIDAuNDEyIDAuMjI2IDAuNjA1IDAuMzI4IDAuMTk3IDAuMTAyIDAuMzg5IDAuMjEzIDAuNTc2IDAuMzI3IDAuMTU4IDAuMDk2IDAuMzI3IDAuMTkzIDAuNTAyIDAuMzAxIDAuMTc0IDAuMTAyIDAuMzQzIDAuMjA5IDAuNTAyIDAuMzI3IDAuNzE3IDAuNTM2IDEuMzc3IDEuMjAzIDIgMi4wMTYgMC42MDcgMC44MDcgMC45MTQgMS44MTIgMC45MTQgMy4wMTUgMCAwLjMwNS0wLjAxOCAwLjYzMi0wLjA1MiAxLjAwNC0wLjAzMyAwLjM3My0wLjEwNyAwLjc0NS0wLjIyNSAxLjExMy0wLjI1NSAwLjg5Ny0wLjc4NSAxLjcxNS0xLjU3NiAyLjQ0NS0wLjgwMyAwLjcyNi0yLjA1NCAwLjgxMS0zLjc2NiAwLjgxMWgtMC4xMDctMC4xMDItMC4wMzVjLTAuMDQ0IDAtMC4wODgtMC4wMTEtMC4xNC0wLjAyMi0wLjA0NC0wLjAxMi0wLjA3OC0wLjAxMi0wLjEwMi0wLjAxMmwtOC4xMTktMC4wMzh2LTIuMzg4aDcuODc3eiIvPg0KICAgICAgICA8cGF0aCBkPSJtMzAuMTU5IDkuMjA4YzAgMy4wODMtMC44NyA1LjY2OS0yLjYyIDcuNzQ5LTEuNzQzIDIuMDg0LTQuMjI1IDMuMTctNy40NDEgMy4yNjRoLTMzLjg0di0yLjYzOWgzMi4zODRjMi4yNjQgMCA0LjAwNC0wLjQ3MyA1LjIyMi0xLjQzMiAxLjIxNC0wLjk1NyAyLjA3OC0yLjAyIDIuNTg2LTMuMTc0IDAuMjk5LTAuNjUxIDAuNTA3LTEuMjg2IDAuNjIyLTEuOTEyIDAuMTE5LTAuNjI2IDAuMTc0LTEuMTU2IDAuMTc0LTEuNTk4di0wLjEwMmMtMC4wMjMtMS45NDMtMC43NjItMy43NDgtMi4yMTgtNS40MTItMS40NTgtMS42NjMtMy41OTItMi42MzctNi4zODYtMi45MTRoLTExLjAxMnYtMi43MDRsMTEuMzEzIDAuMDM0YzAuNDQxIDAgMS4zMTkgMC4wMzMgMS43NzcgMC4xMDQgMC40NjIgMC4wNzEgMC45MjYgMC4xODcgMS4zODkgMC4zNDggMi4wMTMgMC42MDEgMy44NjEgMS44MDcgNS41MzggMy42MTIgMS42NzYgMS44MDcgMi41MTMgNC4wNTEgMi41MTMgNi43Mzl2MC4wMzd6Ii8+DQogICAgPC9nPg0KPC9zdmc+';

    /**
     * @var string Menu slug for the UCSS app
     */
    public static $menu_slug = 'speedify-css';

    /**
     * @var array Data that will be passed to the JavaScript frontend for display.
     */
    public static $display = array();

    /**
     * Initialize the class by hooking the 'add_menu' method to the 'admin_menu' action.
     * This ensures that the admin menu is added when the admin dashboard is being loaded.
     *
     * @return void
     */
    public static function init() {        
        
        //Add the UCSS menu
        add_action( 'admin_menu', array( __CLASS__, 'add_menu' ), 999 );

        //Add any error notices
        add_action( 'admin_notices', array( \UCSS\App\Dashboard::class ,'add_notices' ));

    }

    /**
     * Add the custom menu page to the WordPress admin dashboard.
     * This function defines the title, capability, slug, and callback function for the page.
     * It also adds JavaScript and CSS specifically to this admin page.
     *
     * @return void
     */
    public static function add_menu() {
        
        // Check if the current user has the necessary permissions to view the page.
        if ( ! Auth::is_allowed() ) {
            return;
        }

        //Different menu icon when on our page
        $menu_icon = self::$menu_icon;
        if(isset($_GET['page']) && $_GET['page'] == self::$menu_slug) {
            $menu_icon = self::$menu_icon_selected;
        }

        // Add the custom menu page to the WordPress admin.
        $menu = add_menu_page(
            'Speedify CSS',          // Page title
            'Speedify CSS',          // Menu title
            'manage_options',           // Capability required to view this menu
            self::$menu_slug,      // Menu slug
            array( __CLASS__, 'display' ), // Callback function to display content
            $menu_icon,       // Icon for the menu
            '100'                   // Position in the admin menu
        );


        // Inject the JavaScript and CSS files only when this specific admin page is loaded.
        add_action( 'admin_print_scripts-' . $menu, array( __CLASS__, 'add_js' ) );
    }

    /**
     * Enqueue the JavaScript and CSS required for the custom admin page.
     * This ensures the required assets are loaded only on the specific page.
     *
     * @return void
     */
    public static function add_js() {
        // Enqueue the admin page JavaScript file.
        wp_enqueue_script(
            'speedify_ucss_admin',                      // Handle for the script
            UCSS_PLUGIN_URL . 'assets/index.js', // URL to the script
            array(),                                   // Dependencies (none)
            filemtime( UCSS_PLUGIN_DIR . 'assets/index.js' ), // Version based on file modification time
            true                                       // Load in the footer
        );

        // Enqueue the admin page CSS file.
        wp_enqueue_style(
            'speedify_ucss_admin_style',                // Handle for the style
            UCSS_PLUGIN_URL . 'assets/index.css' // URL to the stylesheet
        );
    }

    /**
     * Display the content for the custom admin page.
     * This function passes configuration and version data to the frontend by injecting it
     * into a global JavaScript object. It also sets up a container for rendering the Vue.js app.
     *
     * @return void
     */
    public static function display() {

        // Get the plugin version.
        $version = UCSS_VER;

        // Get the plugin configuration, removing any non-global values.
        $config  = json_encode( Config::remove_non_global(Config::$config ));

        //Set ajax url
        $ajax_url =  admin_url( 'admin-ajax.php' );

        // Output the necessary data for the frontend into a JavaScript object.
        echo "<script>window.ucss_namespace={config:$config,version:'$version',display:".json_encode(self::$display).",ajaxurl:'$ajax_url'}</script>";

        // Output a container div for the Vue.js app with Tailwind CSS classes.
        echo '<div id="app" class="tailwind"></div>';
    }

}