import { useState } from "react";
import styles from "./PalindromeChecker.module.css";

function PalindromeChecker() {
  const [text, setText] = useState("");
  const [isPalindrome, setIsPalindrome] = useState(null);
  const [result, setResult] = useState("");

  const handleSubmit = (e) => {
    e.preventDefault();
    const cleanedText = text
      .trim()
      .toLowerCase()
      .replace(/[^a-zA-Z0-9]/g, "");
    if (!cleanedText) {
      setResult("Text cannot be empty!");
      return;
    }
    const reversedText = cleanedText.split("").reverse().join("");
    if (reversedText === cleanedText) {
      setIsPalindrome(true);
      setResult("Yes, it is a palindrome!");
    } else {
      setIsPalindrome(false);
      setResult("No, it's not a palindrome!");
    }
  };

  const clearText = () => {
    setText("");
    setResult("");
    setIsPalindrome(null);
  };

  const handleTextChange = (e) => {
    setText(e.target.value);
    if (!e.target.value) setResult("");
  };

  return (
    <div className={styles.palindrome}>
      <h2>Palindrome Checker</h2>
      <form onSubmit={handleSubmit}>
        <input
          type="text"
          style={{ width: "60%", marginRight: "1rem" }}
          placeholder="Enter a word or sentence"
          onChange={handleTextChange}
          value={text}
        />
        <br />
        <button
          type="button"
          onClick={clearText}
          style={{
            backgroundColor: "#fb97f6",
            color: "black",
            margin: "20px 20px 20px 0",
            border: "2px solid #f845ef",
            borderRadius: "4px",
            padding: "10px 16px",
          }}
        >
          Clear text
        </button>
        <button
          type="submit"
          style={{
            backgroundColor: "#3da840",
            color: "black",
            border: "2px solid #05760b",
            borderRadius: "4px",
            margin: "20px 20px 20px 0",
            padding: "10px 16px",
          }}
        >
          Check
        </button>
      </form>

      <div
        className={
          result ? (isPalindrome ? styles.resultTrue : styles.resultFalse) : ""
        }
      >
        {result}
      </div>
    </div>
  );
}

export default PalindromeChecker;
