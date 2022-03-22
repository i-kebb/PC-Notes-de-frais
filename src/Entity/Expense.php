<?php

namespace App\Entity;

use App\Repository\ExpenseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExpenseRepository::class)
 */
class Expense
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="expenses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $comment;

    /**
     * @ORM\Column(type="date")
     */
    private $createdOn;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $refundedOn;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="expensesRefunded")
     */
    private $refundedBy;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $refundWay;

    /**
     * @ORM\Column(type="float")
     */
    private $total;

    /**
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @ORM\OneToMany(targetEntity=ExpenseLine::class, mappedBy="expense")
     */
    private $expenseLines;

    public function __construct()
    {
        $this->expenseLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getCreatedOn(): ?\DateTimeInterface
    {
        return $this->createdOn;
    }

    public function setCreatedOn(\DateTimeInterface $createdOn): self
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    public function getRefundedOn(): ?\DateTimeInterface
    {
        return $this->refundedOn;
    }

    public function setRefundedOn(?\DateTimeInterface $refundedOn): self
    {
        $this->refundedOn = $refundedOn;

        return $this;
    }

    public function getRefundedBy(): ?User
    {
        return $this->refundedBy;
    }

    public function setRefundedBy(?User $refundedBy): self
    {
        $this->refundedBy = $refundedBy;

        return $this;
    }

    public function getRefundWay(): ?string
    {
        return $this->refundWay;
    }

    public function setRefundWay(?string $refundWay): self
    {
        $this->refundWay = $refundWay;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return Collection|ExpenseLine[]
     */
    public function getExpenseLines(): Collection
    {
        return $this->expenseLines;
    }

    public function addExpenseLine(ExpenseLine $expenseLine): self
    {
        if (!$this->expenseLines->contains($expenseLine)) {
            $this->expenseLines[] = $expenseLine;
            $expenseLine->setExpense($this);
        }

        return $this;
    }

    public function removeExpenseLine(ExpenseLine $expenseLine): self
    {
        if ($this->expenseLines->removeElement($expenseLine)) {
            // set the owning side to null (unless already changed)
            if ($expenseLine->getExpense() === $this) {
                $expenseLine->setExpense(null);
            }
        }

        return $this;
    }
}
