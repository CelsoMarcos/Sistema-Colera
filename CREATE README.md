# 🦠 Sistema de Gestão de Casos de Cólera

Este é um sistema web desenvolvido para apoiar o rastreamento, monitoramento e resposta rápida a surtos de cólera em Angola. Ele permite o cadastro de hospitais, ambulâncias, pacientes e visualização de estatísticas em tempo real.

---

## ✅ Funcionalidades já implementadas

### 🔧 Backend (Laravel)
- Módulo de autenticação de usuários via Sanctum
- Cadastro de Províncias e Municípios
- Registro de Hospitais e Ambulâncias
- Controle de estados dos pacientes (Internado, Recuperado, Óbito, etc.)
- Dashboard com estatísticas:
  - Total de pacientes
  - Distribuição por estado
  - Distribuição por província

### 🎨 Frontend (Vue.js + Vite)
- Inicialização do projeto com Tailwind CSS
- Exibição da interface de teste do Vue (funcionando)

---

## 📦 Instalação e Execução

### 🔌 Requisitos
- PHP 8.1+
- Composer
- Node.js e npm
- MySQL
- Laragon (recomendado)

### 🚀 Passos para rodar o backend

```bash
git clone https://github.com/CelsoMarcos/Sistema-Colera.git
cd sistema-colera

# Instalar dependências do Laravel
composer install

# Criar e configurar o .env
cp .env.example .env
php artisan key:generate

# Configurar o banco de dados no .env e executar:
php artisan migrate --seed

# Iniciar o servidor
php artisan serve
```

### 🌐 Rodar o frontend

```bash
cd sistema-colera-frontend
npm install
npm run dev
```

---

## ⚠️ AVISO IMPORTANTE

> Não edite diretamente os arquivos originais do backend ou frontend principal sem antes comunicar a equipe!  
> Use uma nova branch ou forke o repositório para suas alterações. Qualquer mudança direta **pode afetar a estabilidade do projeto.**

---

## 📌 O que ainda falta fazer?

- [ ] Integração completa do frontend com as rotas de API
- [ ] Tela de login e painel administrativo
- [ ] Módulo de triagem de pacientes
- [ ] Integração com Google Maps API (localização de ambulâncias)
- [ ] Exportação de relatórios em PDF

---

## 👥 Colaboradores

- Celso Marcos (autor principal)
- [Adicione outros colaboradores aqui]

---

## 📄 Licença

Este projeto é apenas para fins acadêmicos e de demonstração.
