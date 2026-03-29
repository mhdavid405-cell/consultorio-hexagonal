#!/bin/bash
# docker-up.sh - Script para levantar el proyecto (Linux/Mac)
echo "============================================"
echo "  🏥 Levantando Consultorio Médico"
echo "============================================"
echo ""
echo "  📍 Servidor web: http://localhost:8080"
echo "  📍 phpMyAdmin: http://localhost:8081"
echo "  📍 MySQL: localhost:3307"
echo ""
docker-compose up -d
echo ""
echo "✅ Sistema corriendo!"
