from flask import Flask, request, jsonify
from solver import LinearProgramming

app = Flask(__name__)

@app.route("/solve", methods=["POST"])
def solve():
  try:
    data = request.get_json()
    solver = LinearProgramming(data)
    result = solver.solve()
    return jsonify(result)
  except Exception as e:
    return jsonify({"status": "error", "message": str(e)}), 500

if __name__ == "__main__":
  app.run(host="0.0.0.0", port=5000)
